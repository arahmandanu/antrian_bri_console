const mix = require('laravel-mix');
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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/kios.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .postCss('resources/css/my-font.css', 'public/css', [
        //
    ]).sourceMaps()
    .postCss('resources/css/ticket-style.css', 'public/css', [
        //
    ]).sourceMaps();
// copy custom font
mix.copyDirectory('resources/my_font', 'public/my_font');
mix.setPublicPath('public');
mix.setResourceRoot('../');
