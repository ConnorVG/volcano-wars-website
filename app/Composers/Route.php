<?php

namespace App\Composers;

use Closure;
use Illuminate\Http\Request;

class Route extends Composer
{
    /** @var \Illuminate\Http\Request */
    protected $request;

    /**
     * Constructs a new route composer.
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
        $route = $this->request->route();

        return [
            'route' => new class($route) {
                /** \Illuminate\Routing\Route $route */
                public function __construct($route)
                {
                    $this->route = $route;
                }

                /** string... $names */
                public function is(string... $names) {
                    $route = $this->route ? $this->route->getName() : 'none';


                    foreach ($names as $name) {
                        if (! str_is("get::{$name}", $route)) {
                            continue;
                        }

                        return true;
                    }

                    return false;
                }
            },
        ];
    }
}
