let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copyDirectory('resources/assets/static', 'public/assets/static')
   .sass('resources/assets/styles/app.scss', 'public/assets/styles')
   .js('resources/assets/scripts/app.js', 'public/assets/scripts')
   .extract(['axios', 'laravel-echo', 'lodash', 'pusher-js', 'vue']);
