<?php

namespace App\Composers;

use Illuminate\Http\Request;

class Page extends Composer
{
    /** @var array */
    protected static $titles = [
        'errors' => [
            '401' => 'Unauthorised | {{ application.name }}',
            '403' => 'Forbidden | {{ application.name }}',
            '404' => 'Page Not Found | {{ application.name }}',
            '500' => 'Whoops | {{ application.name }}',
        ],
        'auth' => [
            'sign-in' => 'Sign In | {{ application.name }}',
            'sign-up' => 'Sign Up | {{ application.name }}',
            'forgot' => 'Forgot Password | {{ application.name }}',
            'reset' => 'Reset Password | {{ application.name }}',
        ],
        'common' => [
            'home' => '{{ application.name }}',
            'game' => [
                'servers' => 'Servers | {{ application.name }}',
                'features' => 'Features | {{ application.name }}',
                'download' => 'Download | {{ application.name }}',
                'screenshots' => 'Screenshots | {{ application.name }}',
                'statistics' => 'Statistics | {{ application.name }}',
            ],
        ],
        'personal' => [
            'account' => [
                'Account | {{ application.name }}',
                'password' => 'Change Password | {{ application.name }}',
            ],
        ],
    ];

    /** @var \Illuminate\Http\Request */
    protected $request;

    /**
     * Constructs a new page composer.
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
            'page' => (object) [
                'title' => $this->title(),
                'key' => $this->key(),
            ],
        ];
    }

    /**
     * Get the unique page key.
     *
     * @return string
     */
    protected function key(): string
    {
        $route = $this->request->route();
        $route = $route ? $route->getName() : 'generic';

        $route = preg_replace('/^\w+::/', '$1', $route);
        $route = str_replace(['-', '.'], ['_', '-'], $route);

        return $route;
    }

    /**
     * Get the page title.
     *
     * @return string
     */
    protected function title(): string
    {
        $route = $this->request->route();
        $route = $route ? $route->getName() : null;

        if ($route === null) {
            $route = str_replace('::', '.', $this->name);
        }

        if (($position = strpos($route, '::')) !== 0) {
            $route = substr($route, $position + 2);
        }

        $format = array_get(self::$titles, $route, null);

        if (is_array($format) || $format === null) {
            $format = array_get(self::$titles, "{$route}.0", '{{ application.name }}');
        }

        return preg_replace_callback('/{{\s*([\w\d\.]+)\s*}}/', [$this, 'replace'], $format);
    }

    /**
     * Replace a tag.
     *
     * @param array $match
     *
     * @return string
     */
    protected function replace(array $match)
    {
        $segments = explode('.', $match[1]);
        $value = $this->bag;
        foreach ($segments as $segment) {
            if ($value === null) {
                break;
            }

            if (is_object($value)) {
                $value = object_get($value, $segment);

                continue;
            }

            $value = array_get($value, $segment);
        }

        return (string) $value;
    }
}
