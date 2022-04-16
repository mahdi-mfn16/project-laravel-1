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
    .sass('resources/sass/app.scss', 'public/css');

// mix.sass('resources/sass/blogs/edit.sass', 'public/css/blogs/edit.css');
// // mix.sass('resources/js/blogs/edit.js', 'public/js/blogs/edit.js');
// mix.sass('resources/sass/blogs/index.sass', 'public/css/blogs/index.css');
