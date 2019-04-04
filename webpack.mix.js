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
    .copyDirectory('resources/assets/images', 'public/images')
    .copyDirectory('resources/assets/vendor', 'public/vendor')
    .copyDirectory('node_modules/bootstrap', 'public/vendor/bootstrap')
    .copyDirectory('node_modules/jquery', 'public/vendor/jquery')
    .copyDirectory('node_modules/scrolltofixed', 'public/vendor/scrolltofixed')
    .copyDirectory('node_modules/packery', 'public/vendor/packery')
    .copyDirectory('node_modules/countdown', 'public/vendor/countdown')
    .copyDirectory('node_modules/font-awesome', 'public/vendor/font-awesome')
    .version(['public/css/*.css', 'public/js/*.js']);
