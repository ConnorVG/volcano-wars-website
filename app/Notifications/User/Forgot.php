<?php

namespace App\Notifications\User;

use App\Models\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Forgot extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var string|null */
    protected $token;

    /**
     * Get the notification's delivery channels.
     *
     * @param \App\Models\User $notifiable
     *
     * @return array
     */
    public function via(User $notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param \App\Models\User $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(User $notifiable)
    {
        return (new MailMessage)
            ->subject('Forgot your password?')
            ->markdown('_emails.user.forgot', [
                'token' => $this->getToken($notifiable),
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param \App\Models\User $notifiable
     *
     * @return array
     */
    public function toArray(User $notifiable)
    {
        return [
            //
        ];
    }

    /**
     * Get a generated reset token.
     *
     * @param \App\Models\User $user
     *
     * @return string
     */
    protected function getToken(User $user): string
    {
        if ($this->token === null) {
            $tokens = app(PasswordBroker::class);

            $this->token = $tokens->createToken($user);
        }

        return $this->token;
    }
}
