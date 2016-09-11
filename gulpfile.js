var gulp          = require('gulp');
var autoprefixer  = require('gulp-autoprefixer');
var babel         = require('gulp-babel');
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
	gulp.src('./node_modules/foundation-sites/scss/**/*.*')
		.pipe(gulp.dest('././node_modules/foundation-sites/scss/'));
	gulp.src('./node_modules/foundation-sites/js/**/*.*')
		.pipe(gulp.dest('././node_modules/foundation-sites/js/'));
	gulp.src('./node_modules/bourbon/app/assets/**/*.*')
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
			sourceComments: 'normal'
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
gulp.task('scripts', function() {
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
		'./node_modules/foundation-sites/js/foundation.core.js',
		'./node_modules/foundation-sites/js/foundation.util.mediaQuery.js',

		// Choose the individual plugins you want in your project
		'./node_modules/foundation-sites/js/foundation.abide.js',
		'./node_modules/foundation-sites/js/foundation.accordion.js',
		'./node_modules/foundation-sites/js/foundation.accordionMenu.js',
		'./node_modules/foundation-sites/js/foundation.drilldown.js',
		'./node_modules/foundation-sites/js/foundation.dropdown.js',
		'./node_modules/foundation-sites/js/foundation.dropdownMenu.js',
		'./node_modules/foundation-sites/js/foundation.equalizer.js',
		'./node_modules/foundation-sites/js/foundation.interchange.js',
		'./node_modules/foundation-sites/js/foundation.magellan.js',
		'./node_modules/foundation-sites/js/foundation.offcanvas.js',
		'./node_modules/foundation-sites/js/foundation.orbit.js',
		'./node_modules/foundation-sites/js/foundation.responsiveMenu.js',
		'./node_modules/foundation-sites/js/foundation.responsiveToggle.js',
		'./node_modules/foundation-sites/js/foundation.reveal.js',
		'./node_modules/foundation-sites/js/foundation.slider.js',
		'./node_modules/foundation-sites/js/foundation.sticky.js',
		'./node_modules/foundation-sites/js/foundation.tabs.js',
		'./node_modules/foundation-sites/js/foundation.toggler.js',
		'./node_modules/foundation-sites/js/foundation.tooltip.js',
		'./node_modules/foundation-sites/js/foundation.util.box.js',
		'./node_modules/foundation-sites/js/foundation.util.keyboard.js',
		'./node_modules/foundation-sites/js/foundation.util.motion.js',
		'./node_modules/foundation-sites/js/foundation.util.nest.js',
		'./node_modules/foundation-sites/js/foundation.util.timerAndImageLoader.js',
		'./node_modules/foundation-sites/js/foundation.util.touch.js',
		'./node_modules/foundation-sites/js/foundation.util.triggers.js',
	])
	.pipe(babel({
		presets: ['es2015'],
		compact: true
	}))
	.pipe(concat('foundation.js'))
	.pipe(gulp.dest('./assets/dist/'))
	.pipe(rename({suffix: '.min'}))
	.pipe(uglify())
	.pipe(gulp.dest('./assets/dist/'))
	.pipe(notify({ message: "Foundation JS task complete!"}));
});

// Watch function
// =========================================================
gulp.task('watch', ['styles', 'scripts'], function() {
	gulp.watch('./assets/scss/**/*.scss', ['styles']);
	gulp.watch('./assets/javascripts/**/*.js', ['scripts']);
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
gulp.task('build', ['styles', 'scripts', 'package']);

// Default task
// =========================================================
gulp.task('default', ['watch', 'foundation-js', 'browser-sync']);
