var gulp = require('gulp');
var rename = require('gulp-rename');
var sass = require('gulp-sass');

gulp.task('styles', function () {
	return gulp.src('./assets/scss/*.scss')
		.pipe(sass({
			outputStyle: 'expanded',
			errLogToConsole: true
		}))
		.pipe(gulp.dest('./'))
		.pipe(sass({
			outputStyle: 'compressed',
			errLogToConsole: true
		}))
		.pipe(rename("style.min.css"))
		.pipe(gulp.dest('./'))
});

gulp.task('build', ['styles']);

gulp.task('watch', ['build'], function() {
	gulp.watch('./scss/*.scss', ['styles']);
})

gulp.task('default', ['build']);