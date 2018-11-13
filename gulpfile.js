var gulp          = require('gulp');
var autoprefixer  = require('gulp-autoprefixer');
var babel         = require('gulp-babel');
var cleanCSS      = require('gulp-clean-css');
var concat        = require('gulp-concat');
var header        = require('gulp-header');
var minimist      = require('minimist');
var rename        = require('gulp-rename');
var replace       = require('gulp-replace');
var notify        = require('gulp-notify');
var sass          = require('gulp-sass');
var sourcemaps    = require('gulp-sourcemaps');
var uglify        = require('gulp-uglify');
var zip           = require('gulp-zip');
var browserSync   = require('browser-sync');
var reload        = browserSync.reload;

// File sets to use for search and replace
var searchFiles = {
	// Files that have our current version output
	version: [
		'README.md',
		'package.json',
		'assets/scss/style.scss',
		'style.css'
	],
	// Files we never want to edit
	exclude: [
		'!./node_modules/**'
	]
};

// Save passed parameters to use in gulp tasks
var options = minimist(process.argv.slice(2));

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

// Update versions
// =========================================================
gulp.task('version', function() {
	// Check if the exclude array exists and pass it or an empty array into `src`
	var src = typeof searchFiles['exclude'] != "undefined" ? searchFiles['exclude'] : [];

	// Check if all required parameters have been set
	if ((options.s == undefined) || (options.r == undefined) || (options.f == undefined)) {
		// If any are missing, output a usage error
		console.error('USAGE: gulp replace -s <SEARCH> -r <REPLACE> -f <FILES>');
	} else {
		// Check if the passed files is the key of an existing searchFiles array
		if (searchFiles[options.f] != undefined) {
			// If so, combine it with our excludes array
			src = searchFiles[options.f].concat(src);
		} else {
			// If not, create an array using the passed string (split by `,`)
			// and combine it with excludes array
			src = String(options.f)
			.replace(/\s+/g, '')
			.split(',')
			.concat(src);
		}

		// Example gulp version -s 1.0.0 -r 1.0.1 -f version
		// Run our task!
		return gulp.src(src, { base: './' })
			.pipe(replace(String(options.s), String(options.r)))
			.pipe(gulp.dest('./'));
	}
});

// Search and replace
// =========================================================
gulp.task('replace', function() {
	return gulp.src(['**', '!./node_modules/**', '!./gulpfile.js', '!./library/'], { base: './' })
		.pipe(replace('hybrid-foundation', 'new-theme'))
		.pipe(replace('hybrid_foundation', 'new_theme'))
		.pipe(replace('hybrid-base', 'new-theme'))
		.pipe(replace('hybrid_base', 'new_theme'))
		.pipe(replace('Hybrid_Foundation', 'New_Theme'))
		.pipe(replace('Hybrid Foundation', 'New Theme'))
		.pipe(replace('HYBRID_FOUNDATION', 'NEW_THEME'))
		.pipe(gulp.dest('./'));
});

// Default task
// =========================================================
gulp.task('default', ['watch', 'browser-sync']);
