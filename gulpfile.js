// Load all the modules from package.json
var gulp = require( 'gulp' ),
  plumber = require( 'gulp-plumber' ),
  watch = require( 'gulp-watch' ),
  browserSync = require('browser-sync'),
  reload      = browserSync.reload,
  minifycss = require( 'gulp-minify-css' ),
  uglify = require( 'gulp-uglify' ),
  rename = require( 'gulp-rename' ),
  notify = require( 'gulp-notify' ),
  concat = require('gulp-concat'),
  sass = require( 'gulp-sass' );
  imagemin = require('gulp-imagemin');
  pngquant = require('imagemin-pngquant');


// Default error handler
var onError = function( err ) {
  console.log( 'An error occured:', err.message );
  this.emit('end');
}

// Reloads browser after scripts process
gulp.task('js-watch', ['scripts'], browserSync.reload);

// Concatenates all files that it finds in the manifest
// and creates two versions: normal and minified.
// It's dependent on the jshint task to succeed.
gulp.task( 'scripts', function() {
  return gulp.src( ['../../../wp-includes/js/jquery/jquery.js', './js/src/*.js'] )
    .pipe(concat('scripts.js'))
    .pipe( gulp.dest( './js/dist' ) )
    // Normal done, time to create the minified javascript (scripts.min.js)
    // remove the following 3 lines if you don't want it
    .pipe( uglify() )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( gulp.dest( './js/dist' ) );
} );

// As with javascripts this task creates two files, the regular and
// the minified one. It automatically reloads browser as well.
gulp.task('scss', function() {
  return gulp.src('./sass/style.scss')
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( sass() )
    .pipe( gulp.dest( '.' ) )
    // Normal done, time to do minified (style.min.css)
    // remove the following 3 lines if you don't want it
    .pipe( minifycss() )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( gulp.dest( '.' ) )
    .pipe(browserSync.stream());
});

gulp.task('scss-page', function() {
  return gulp.src('./sass/page-specific/*.scss')
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( sass() )
    .pipe( minifycss() )
    .pipe( gulp.dest( './css' ) )
    .pipe(browserSync.stream());
});


// Watch files for change
gulp.task( 'watch', function() {
  // don't listen to whole js folder, it'll create an infinite loop
  gulp.watch( [ './js/**/*.js', '!./js/dist/*.js' ], [ 'js-watch' ] );

  gulp.watch( ['./sass/**/*.scss', '!./sass/page-specific/*.scss'], ['scss'] );
  gulp.watch( './sass/page-specific/*.scss', ['scss-page'] );

  gulp.watch( './**/*.php' ).on( 'change',browserSync.reload);
} );

//Image Optimization
gulp.task('images', function(){
	return gulp.src('images-source/**')
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()]
		}))
		.pipe(gulp.dest('images'));
});


// Start browser-sync as a proxy
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "piketopine.dev",
	      port: 8806
    });
});

gulp.task( 'build', ['images','scss', 'scss-page', 'scripts'] );
gulp.task( 'default', ['images','browser-sync','build','watch'], function() {
 // Does nothing in this task, just triggers the dependent 'watch'
} );
