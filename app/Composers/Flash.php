<?php

namespace App\Composers;

use App\Support\Flash as FlashSupport;

class Flash extends Composer
{
    /** @var \App\Support\Flash */
    protected $flash;

    /**
     * Creates a new flash composer.
     *
     * @param \App\Support\Flash $flash
     */
    public function __construct(FlashSupport $flash)
    {
        $this->flash = $flash;
    }

    /**
     * Get the data to provide to the view.
     *
     * @return array
     */
    protected function data(): array
    {
        return [
            'flash' => $this->flash->pull(),
        ];
    }
}
