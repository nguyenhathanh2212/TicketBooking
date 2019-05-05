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
    .copyDirectory('node_modules/jquery-ui-dist', 'public/vendor/jquery-ui-dist')
    .copyDirectory('node_modules/scrolltofixed', 'public/vendor/scrolltofixed')
    .copyDirectory('node_modules/packery', 'public/vendor/packery')
    .copyDirectory('node_modules/countdown', 'public/vendor/countdown')
    .copyDirectory('node_modules/font-awesome', 'public/vendor/font-awesome')
    .copyDirectory('node_modules/eonasdan-bootstrap-datetimepicker', 'public/vendor/datetimepicker')
    .copyDirectory('node_modules/moment', 'public/vendor/moment')
    .copyDirectory('node_modules/bootstrap-rating', 'public/vendor/bootstrap-rating')
    .version(['public/css/*.css', 'public/js/*.js']);

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            '@': __dirname + '/resources/js',
            '@components': __dirname + '/resources/js/components',
            '@plugins': __dirname + '/resources/js/components/plugins',
            '@home': __dirname + '/resources/js/components/home',
            '@company': __dirname + '/resources/js/components/company',
            '@route': __dirname + '/resources/js/components/route',
            '@station': __dirname + '/resources/js/components/station',
            '@layout': __dirname + '/resources/js/components/layout'
        },
    },
})
