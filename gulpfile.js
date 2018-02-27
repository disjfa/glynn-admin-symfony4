let gulp = require('gulp');
let favicons = require('gulp-favicons');
let log = require('fancy-log');

gulp.task('favicons', function () {
  return gulp.src('./assets/logo.png').pipe(favicons({
    appName: 'Glynn admin',
    appDescription: 'Glynn admin starter',
    developerName: 'disjfa',
    developerURL: 'http://disjfa.nl/',
    background: '#3d566e',
    theme_color: '#ffffff',
    path: '/icons/',
    url: 'http://disjfa.nl/',
    display: 'standalone',
    orientation: 'portrait',
    start_url: '/?homescreen=1',
    version: 1.0,
    logging: false,
    online: false,
    html: 'index.html',
    pipeHTML: true,
    replace: true
  }))
    .on('error', log)
    .pipe(gulp.dest('./public/icons'));
});