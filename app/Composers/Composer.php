<?php

namespace App\Composers;

use Illuminate\Contracts\View\View;

abstract class Composer
{
    /**
     * The data cache.
     *
     * @var array
     */
    protected static $cache = [];

    /**
     * The view name.
     *
     * @var array
     */
    protected $name = null;

    /**
     * The view data bag.
     *
     * @var array
     */
    protected $bag = [];

    /**
     * Compose the view.
     *
     * @param \Illuminate\Contracts\View\View $view
     *
     * @return void
     */
    public function compose(View $view): void
    {
        $this->name = $view->getName();
        $this->bag = $view->getData();

        $view->with($this->cached());
    }

    /**
     * Get the cached data.
     *
     * @return array
     */
    protected function cached(): array
    {
        if (! isset(self::$cache[static::class])) {
            self::$cache[static::class] = $this->data();
        }

        return self::$cache[static::class];
    }

    /**
     * Get the data to provide to the view.
     *
     * @return array
     */
    abstract protected function data(): array;
}
