// webpack.config.js
const Encore = require('@symfony/webpack-encore');
const { InjectManifest } = require('workbox-webpack-plugin');

Encore
// the project directory where all compiled assets will be stored
  .setOutputPath('public/build/')
  // the public path used by the web server to access the previous directory
  .setPublicPath('/build')
  // will create public/build/app.js and public/build/app.css
  .addEntry('admin', './assets/admin/js/admin.js')
  .addEntry('site', './assets/site/js/site.js')
  // allow sass/scss files to be processed
  .enableSassLoader()
  // allow legacy applications to use $/jQuery as a global variable
  .autoProvidejQuery()
  .enableSourceMaps(!Encore.isProduction())
  // enable vue
  .enableVueLoader()
  // show OS notifications when builds finish/fail
  .enableBuildNotifications()
  .enableSingleRuntimeChunk()
  // Add workbox plugin
  .addPlugin(new InjectManifest({
    // globDirectory: 'public/',
    // globPatterns: ['**/*.{html,js,css,jpg,png,woff2,woff,ttf,json}'],
    swSrc: './assets/sw.js',
    swDest: './../sw.js',
    templatedUrls: {
      'offline.html': 'url'
    }
  }))
;

if (Encore.isProduction()) {
  Encore
  // Enable post css loader
    .enablePostCssLoader()
    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()
    // create hashed filenames (e.g. app.abc123.css)
    .enableVersioning()
  ;
}

// export the final configuration
module.exports = Encore.getWebpackConfig();
