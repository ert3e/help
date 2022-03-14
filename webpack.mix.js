const mix = require('laravel-mix');
const webpack = require('webpack');

mix.webpackConfig({

});

mix.options({ processCssUrls: false });

mix.sass('resources/sass/admin/style.scss', 'css/admin/style.css')
    .sass('resources/sass/site/style.scss', 'css/site/style.css')
    .js('resources/js/admin/app.js', 'js/admin/app.js')
    .js('resources/js/site/app.js', 'js/site/app.js');

mix.browserSync('fond:8888');

mix.version();
