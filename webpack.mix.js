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

mix
    .setPublicPath('public_html')
    .js('resources/js/app.js', 'public_html/js')
    // .postCss('resources/css/app.css', 'public_html/css', [
    //     require('postcss-import'),
    //     require('tailwindcss'),
    //     require('autoprefixer'),
    // ])
    .sass('resources/sass/app.scss', 'public_html/css')
    .options({
        processCssUrls: false,
        postCss: [
            require('postcss-import'),
            require('tailwindcss'),
            require('autoprefixer'),
        ],
    })
    .copy('node_modules/ace-builds/src-min', 'public_html/vendor/ace')
    .browserSync('127.0.0.1:8000')
    .disableSuccessNotifications();

if (mix.inProduction()) {
    mix.version();
}
