const mix = require("laravel-mix");
let path = require('path');

mix
  .alias({
    'laravel-nova': path.join(__dirname, 'vendor/laravel/nova/resources/js/mixins/packages.js'),
  })
  .setPublicPath("dist")
  .js("resources/js/field.js", "js")
  .vue({ version: 3 })
  .sass("resources/sass/field.scss", "css")
  .webpackConfig({
      externals: {
        vue: 'Vue',
      },
      output: {
        uniqueName: 'dinandmentink/nova-markdown',
      }
    })
