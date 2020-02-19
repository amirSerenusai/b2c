const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/bootstrap.js', 'public/js')
    .js('resources/js/custom_functions.js', 'public/js')
    .js('resources/js/api_calls.js', 'public/js')
    .js('resources/js/paypal.js', 'public/js')
    .js('resources/js/contact.js', 'public/js')
    .js('resources/js/functions.js', 'public/js');
    // .sass('resources/sass/app.scss', 'public/css');
