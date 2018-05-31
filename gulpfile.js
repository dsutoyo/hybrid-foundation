var gulp          = require('gulp');
var autoprefixer  = require('gulp-autoprefixer');
var babel         = require('gulp-babel');
var cleanCSS      = require('gulp-clean-css');
var concat        = require('gulp-concat');
var header        = require('gulp-header');
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
		proxy: 'https://themes.dev.cc/'
	});
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
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'expanded',
			sourceComments: 'normal'
		}).on('error', notify.onError(function(error) {
			return "Error: " + error.message;
		})))
		.pipe(autoprefixer({
			browsers: ['last 2 versions', 'ie >= 9']
		}))
		.pipe(gulp.dest('./assets/dist/'))
		.pipe(rename({suffix: '.min'}))
		.pipe(cleanCSS({
			keepSpecialComments:0
		}))
		.pipe(header())
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('./assets/dist/'))
		.pipe(reload({stream:true}))
		.pipe(notify({message: "Styles task complete!"}));
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
		.pipe(notify({message: "Scripts task complete!"}));
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
gulp.task('default', ['watch', 'browser-sync']);
