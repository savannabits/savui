const mix = require('laravel-mix');

require('laravel-mix-tailwind');

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

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css')
   .tailwind('./tailwind.config.js');
mix.js(['resources/js/admin/admin.js'], 'public/js')
    .js(['resources/js/web/web.js'],'public/js')
    .sass('resources/sass/admin/admin.scss', 'public/css')
    .sass('resources/sass/admin/styles/wizard.scss', 'public/css');

if (mix.inProduction()) {
  mix
   .version();
}
