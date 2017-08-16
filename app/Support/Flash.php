<?php

namespace App\Support;

use Illuminate\Contracts\Session\Session;

class Flash
{
    /** @var \Illuminate\Contracts\Session\Session */
    protected $session;

    /** @var array */
    protected $messages = [];

    /**
     * Creates a new flash service.
     *
     * @param \Illuminate\Contracts\Session\Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Puts the messages into the session.
     *
     * @return void
     */
    public function put(): void
    {
        if (empty($this->messages)) {
            return;
        }

        $mapped = [];
        foreach ($this->messages as $class => $messages) {
            $mapped = array_merge(
                $mapped,
                array_map(function ($message) use ($class) {
                    return compact('class', 'message');
                }, $messages)
            );
        }

        $this->session->put('_flash_messages', $mapped);
    }

    /**
     * Adds a message.
     *
     * @param string $class
     * @param string $message
     *
     * @return void
     */
    public function add(string $class, string $message): void
    {
        if (! isset($this->messages[$class])) {
            $this->messages[$class] = [];
        }

        $this->messages[$class][] = $message;
    }

    /**
     * Pull the flash messages out of the session.
     *
     * @return array
     */
    public function pull(): array
    {
        static $messages = null;
        if ($messages === null) {
            $messages = (array) $this->session->pull('_flash_messages', []);
        }

        return $messages;
    }
}
