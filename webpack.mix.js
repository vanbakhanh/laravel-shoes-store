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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/css/dataTables.bootstrap4.min.css',
    'resources/assets/css/simple-sidebar.css',
    'resources/assets/css/style.css',
], 'public/css/all.css');

mix.scripts([
	'resources/assets/js/jquery-3.3.1.min.js',
	'resources/assets/js/popper.min.js',
	'resources/assets/js/jquery.dataTables.min.js',
    'resources/assets/js/bootstrap.min.js',
    'resources/assets/js/dataTables.bootstrap4.min.js',
], 'public/js/all.js');