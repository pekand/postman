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

if (mix.inProduction()) {
    mix
    .version() // add hash to names
    .sourceMaps();
}

mix
.webpackConfig({devtool: 'source-map'}) // custom webpack config
.styles([
    'resources/css/app.css', // merge native css files
], 'public/css/styles.css')
.js('resources/js/bootstrap.js', 'public/js')
.js('resources/js/app.js', 'public/js')
.vue()
.sass('resources/sass/app.scss', 'public/css')
.extract(['axios', 'jquery', 'bootstrap', 'vue', 'react'])
.sourceMaps();
