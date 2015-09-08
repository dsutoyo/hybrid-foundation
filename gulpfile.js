var gulp        = require('gulp');
var rename      = require('gulp-rename');
var sass        = require('gulp-sass');
var zip         = require('gulp-zip');
var browserSync = require('browser-sync');
var reload      = browserSync.reload;

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
gulp.task('foundation', function() {
	gulp.src('./bower_components/foundation/**/*.*')
		.pipe(gulp.dest('./assets/vendor/foundation'));
});

gulp.task('font-awesome', function() {
	gulp.src('./bower_components/components-font-awesome/**/*.*')
		.pipe(gulp.dest('./assets/vendor/font-awesome'));
	gulp.src('./bower_components/components-font-awesome/fonts/**/*.*')
		.pipe(gulp.dest('./assets/fonts'));
});

// Compile our stylesheets
// =========================================================
gulp.task('styles', function() {
	gulp.src('./assets/scss/editor-style.scss')
		.pipe(sass({
			outputStyle: 'expanded'
		}))
		.pipe(gulp.dest('./assets/stylesheets/'));
	return gulp.src('./assets/scss/style.scss')
		.pipe(sass({
			outputStyle: 'expanded',
		}).on('error', function (err) {
			sass.logError(err);
			this.emit('end');
		}))
		.pipe(gulp.dest('./'))
		.pipe(sass({
			outputStyle: 'compressed',
		}).on('error', function (err) {
			sass.logError(err);
			this.emit('end');
		}))
		.pipe(rename("style.min.css"))
		.pipe(gulp.dest('./'))
		.pipe(reload({stream:true}));
});

// Watch function
// =========================================================
gulp.task('watch', function() {
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