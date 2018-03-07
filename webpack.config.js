// webpack.config.js
let Encore = require('@symfony/webpack-encore');
let WorkboxPlugin = require('workbox-webpack-plugin');

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

  // empty the outputPath dir before each build
  .cleanupOutputBeforeBuild()

  // show OS notifications when builds finish/fail
  .enableBuildNotifications()

  // create hashed filenames (e.g. app.abc123.css)
  .enableVersioning(Encore.isProduction())

  // Add workbox plugin
  .addPlugin(new WorkboxPlugin({
    globDirectory: 'public',
    globPatterns: ['**/*.{html,js,css,jpg,png,woff2,woff,ttf,json}'],
    swSrc: './assets/sw.js',
    swDest: './public/sw.js',
    templatedUrls: { 'offline.html': 'url' },
    clientsClaim: true,
    skipWaiting: true
  }))

;

if (Encore.isProduction()) {
  // Enable post css loader
  Encore.enablePostCssLoader();
}

// export the final configuration
module.exports = Encore.getWebpackConfig();
