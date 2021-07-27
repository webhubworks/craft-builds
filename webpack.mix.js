const mix = require('laravel-mix');
const path = require('path');

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
    .vue()
    .sourceMaps()
    .postCss('resources/css/app.css', 'public/css')
    .options({
        postCss: [
            require('tailwindcss'),
        ],
    })
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve('resources/js'),
                'public': path.resolve('public'),
            },
        },
    })

mix.browserSync({
    proxy: process.env.APP_URL,
    host: process.env.APP_URL,
    open: 'external',
    files: [
        'resources/**/*.blade.php',
        'resources/**/*.js',
        'resources/**/*.vue',
        'resources/**/*.css',
        'resources/**/*.svg',
        'resources/**/*.php',
        'tailwind.config.js'
    ]
})
