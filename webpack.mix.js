const mix = require('laravel-mix');
require('laravel-mix-purgecss');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js(['public/js/plugins.min.js'], 'public/template/js/errandia.js')
    .styles(['public/css/plugins.min.css','public/css/style.light-blue-500.min.css'], 'public/template/css/errandia.css')
    .purgeCss();
