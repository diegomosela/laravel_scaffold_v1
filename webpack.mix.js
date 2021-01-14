let mix         = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 */

mix

.sass('resources/scss/bundle.scss',
    'public/assets/css/all.min.css')

.styles('resources/js/main.js',
    'public/assets/js/main.min.js');

//browserify resources/js/bundle.js -o public/assets/js/all.min.js