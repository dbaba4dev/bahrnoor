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
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/global.scss', 'public/css');

mix.styles([
    'resources/css/bootstrap.min.css',
    'resources/css/font-awesome.min.css',
    'resources/css/ionicons.min.css',
    'resources/css/AdminLTE.min.css',
    'resources/css/skins/_all-skins.min.css'

], 'public/css/all.css');

mix.scripts([
    'resources/js/jquery.min.js',
    'resources/js/bootstrap.min.js',
    'resources/js/jquery.slimscroll.min.js',
    'resources/js/fastclick.js',
    'resources/js/adminlte.min.js',
    'resources/js/demo.js'

], 'public/js/all.js');
