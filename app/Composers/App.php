<?php

namespace App\Composers;

use Illuminate\Http\Request;

class App extends Composer
{
    /** @var \Illuminate\Http\Request */
    protected $request;

    /**
     * Constructs a new app composer.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the data to provide to the view.
     *
     * @return array
     */
    protected function data(): array
    {
        return [
            'application' => (object) [
                'name' => config('app.name'),
                'locale' => $this->request->getLocale(),
                'copyright' => '&copy; Connor S. Parks ' . date('Y') . '. All rights reserved.',
            ],
        ];
    }
}
