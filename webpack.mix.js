const mix = require('laravel-mix');
require('laravel-mix-polyfill');
require('laravel-mix-purgecss');

// Add an alias for loading our js resources in tests
mix.webpackConfig({
     resolve: {
        alias: {
          '@': path.resolve(__dirname, 'resources/js'),
        },
    }
});

// Polyfill our files for ie11 compatibility
mix.polyfill({
    enabled: true,
    useBuiltIns: "usage",
    targets: {"ie": 11}
});

// Create our source maps for our different environments
mix.sourceMaps(true, 'inline-source-map', 'hidden-source-map');

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
 mix.js('resources/js/public/public.js', 'public/js')
    .js('resources/js/app/app.js', 'public/js')
    .sass('resources/styles/vendor.scss', 'public/css')
    .postCss('resources/styles/main.css', 'public/css')
    .options({
        postCss: [require('tailwindcss')]
    })
    .purgeCss({
        enabled: true,
        whitelistPatterns: [/^bg-.*$/], // Keeg app bg 
    });