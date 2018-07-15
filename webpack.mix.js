const { mix } = require('laravel-mix');

const ASSETS_PATH = 'resources/assets/';
const PUBLIC_PATH = 'public/';
const NODE_PATH = 'node_modules/';
const SCSS_PATH = 'resources/assets/sass/';

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

mix.copyDirectory(NODE_PATH + 'bootswatch/dist/materia/bootstrap.min.css', PUBLIC_PATH + 'css')
	.copyDirectory(ASSETS_PATH + 'css/dataTables.bootstrap4.min.css', PUBLIC_PATH + 'css')
	.copyDirectory(ASSETS_PATH + 'css/dashboard.css', PUBLIC_PATH + 'css')
	.copyDirectory(ASSETS_PATH + 'css/style.css', PUBLIC_PATH + 'css')
	.copyDirectory(ASSETS_PATH + 'img', PUBLIC_PATH + 'images')
	.copyDirectory(NODE_PATH + 'jquery/dist/jquery.min.js', PUBLIC_PATH + 'js')
	.copyDirectory(NODE_PATH + 'popper.js/dist/umd/popper.min.js', PUBLIC_PATH + 'js')
	.copyDirectory(NODE_PATH + 'bootstrap/dist/js/bootstrap.min.js', PUBLIC_PATH + 'js')
	.scripts([
		'resources/assets/js/jquery.dataTables.min.js',
	    'resources/assets/js/dataTables.bootstrap4.min.js',
	], 'public/js/dataTable.js')
	.version();
