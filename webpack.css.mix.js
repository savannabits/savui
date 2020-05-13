const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')
require('laravel-mix-tailwind');
require('laravel-mix-merge-manifest')

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
mix.setResourceRoot(`/${process.env.MIX_APP_URI || ''}/`);
mix
    .sass('resources/sass/app.scss', 'public/css')
    .tailwind('./tailwind.config.js')
    .sass('resources/sass/admin/admin.scss', 'public/css')
    .sass('resources/sass/admin/styles/wizard.scss', 'public/css')
    .mergeManifest()
;

if (mix.inProduction()) {
  mix.version();
}
