<?php

namespace App\Notifications\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Reset extends Notification implements ShouldQueue
{
    use Queueable;

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
            ->subject('Password successfully reset!')
            ->markdown('_emails.user.reset');
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
}
