var gulp          = require('gulp');
var autoprefixer  = require('gulp-autoprefixer');
var concat        = require('gulp-concat');
var rename        = require('gulp-rename');
var notify        = require('gulp-notify');
var sass          = require('gulp-sass');
var sourcemaps    = require('gulp-sourcemaps');
var uglify        = require('gulp-uglify');
var zip           = require('gulp-zip');
var browserSync   = require('browser-sync');
var reload        = browserSync.reload;

// Browser sync
// =========================================================
gulp.task('browser-sync', function() {
	var files = [
		'**/*.php'
	];

	browserSync.init(files, {
		proxy: 'wordpress.dev/'
	});
});

// Moving dependencies into place
// =========================================================
gulp.task('deps', function() {
	gulp.src('./bower_components/foundation-sites/scss/**/*.*')
		.pipe(gulp.dest('./../../bower_components/foundation-sites/scss/'));
	gulp.src('./bower_components/foundation-sites/js/**/*.*')
		.pipe(gulp.dest('./../../bower_components/foundation-sites/js/'));
	gulp.src('./bower_components/bourbon/app/assets/**/*.*')
		.pipe(gulp.dest('./assets/vendor/bourbon'));
});

// Compile our stylesheets
// =========================================================
gulp.task('styles', function() {
	gulp.src('./assets/scss/editor-style.scss')
		.pipe(sass({
			outputStyle: 'expanded'
		}))
		.pipe(gulp.dest('./assets/stylesheets/'));
	gulp.src('./assets/scss/style.scss')
		.pipe(sass({
			outputStyle: 'expanded',
		}).on('error', notify.onError(function(error) {
			return "Error: " + error.message;
		})))
		.pipe(autoprefixer({
			browsers: ['last 2 versions', 'ie >= 9']
		}))
		.pipe(gulp.dest('./assets/dist/'));
	gulp.src('./assets/scss/style.scss')
		.pipe(sass({
			outputStyle: 'compressed',
		}))
		.pipe(autoprefixer({
			browsers: ['last 2 versions', 'ie >= 9']
		}))
		.pipe(rename("style.min.css"))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('./assets/dist/'))
		.pipe(reload({stream:true}));
});

// Compile our scripts
// =========================================================
gulp.task('scripts', ['foundation-js'], function() {
	return gulp.src('assets/javascripts/**/*.js')
		.pipe(concat('app.js'))
		.pipe(gulp.dest('./assets/dist/'))
		.pipe(rename({suffix: '.min'}))
		.pipe(uglify()
		.on('error', notify.onError(function(error) {
			return "Error: " + error.message;
		}))
		)
		.pipe(gulp.dest('./assets/dist/'))
		.pipe(reload({stream:true}))
		.pipe(notify({ message: "Scripts task complete!"}));
});

// Foundation JS task, which gives us flexibility to choose what plugins we want
// https://github.com/ZeekInteractive/heisenberg
// =========================================================
gulp.task('foundation-js', function() {
	return gulp.src([

		/* Choose what JS Plugin you'd like to use. Note that some plugins also
		require specific utility libraries that ship with Foundation—refer to a
		plugin's documentation to find out which plugins require what, and see
		the Foundation's JavaScript page for more information.
		http://foundation.zurb.com/sites/docs/javascript.html */

		// Core Foundation - needed when choosing plugins ala carte
		'../../bower_components/foundation-sites/js/foundation.core.js',

		// Choose the individual plugins you want in your project
		'../../bower_components/foundation-sites/js/foundation.abide.js',
		'../../bower_components/foundation-sites/js/foundation.accordion.js',
		'../../bower_components/foundation-sites/js/foundation.accordionMenu.js',
		'../../bower_components/foundation-sites/js/foundation.drilldown.js',
		'../../bower_components/foundation-sites/js/foundation.dropdown.js',
		'../../bower_components/foundation-sites/js/foundation.dropdownMenu.js',
		'../../bower_components/foundation-sites/js/foundation.equalizer.js',
		'../../bower_components/foundation-sites/js/foundation.interchange.js',
		'../../bower_components/foundation-sites/js/foundation.magellan.js',
		'../../bower_components/foundation-sites/js/foundation.offcanvas.js',
		'../../bower_components/foundation-sites/js/foundation.orbit.js',
		'../../bower_components/foundation-sites/js/foundation.responsiveMenu.js',
		'../../bower_components/foundation-sites/js/foundation.responsiveToggle.js',
		'../../bower_components/foundation-sites/js/foundation.reveal.js',
		'../../bower_components/foundation-sites/js/foundation.slider.js',
		'../../bower_components/foundation-sites/js/foundation.sticky.js',
		'../../bower_components/foundation-sites/js/foundation.tabs.js',
		'../../bower_components/foundation-sites/js/foundation.toggler.js',
		'../../bower_components/foundation-sites/js/foundation.tooltip.js',
		'../../bower_components/foundation-sites/js/foundation.util.box.js',
		'../../bower_components/foundation-sites/js/foundation.util.keyboard.js',
		'../../bower_components/foundation-sites/js/foundation.util.mediaQuery.js',
		'../../bower_components/foundation-sites/js/foundation.util.motion.js',
		'../../bower_components/foundation-sites/js/foundation.util.nest.js',
		'../../bower_components/foundation-sites/js/foundation.util.timerAndImageLoader.js',
		'../../bower_components/foundation-sites/js/foundation.util.touch.js',
		'../../bower_components/foundation-sites/js/foundation.util.triggers.js',
	])
	.pipe(concat('foundation.js'))
	.pipe(uglify())
	.pipe(gulp.dest('./assets/dist/'));
});

// Watch function
// =========================================================
gulp.task('watch', ['styles', 'scripts'], function() {
	gulp.watch('./assets/scss/**/*.scss', ['styles']);
})

// Package it up for distribution
// =========================================================
gulp.task('package', function() {
	return gulp.src(['./*', './+(assets|comment|content|inc|languages|library|menu|misc|sidebar)/**/*'], {base: "."})
		.pipe(zip('archive.zip'))
		.pipe(gulp.dest('./'));
});

// Build an updated package
// =========================================================
gulp.task('build', ['styles', 'package']);

// Default task
// =========================================================
gulp.task('default', ['watch', 'browser-sync']);
