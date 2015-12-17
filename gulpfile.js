var  concat = require('gulp-concat'),
	gulp = require('gulp'),
	plumber = require('gulp-plumber'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps'),
	uglify = require('gulp-uglify'),
	watch = require('gulp-watch');

var path = {
	src: {
		scripts: './public/js/',
		scss: './public/scss/'
	},
	dest: './public/',
};

var plumber_error = function(err) {
	gutil.beep();
	gutil.log(err);
	this.emit('end');
};

gulp.task('dev:build:scss', function() {
	return gulp.src( path.src.scss + '*.scss' )
		.pipe(plumber(plumber_error))
		.pipe(sourcemaps.init())
		.pipe(sass({outputStyle: 'compressed'}))
		.pipe(sourcemaps.write())
		.pipe(plumber.stop())
		.pipe(gulp.dest( path.dest+'/css' ));
});

gulp.task('dev:build:js', function() {
	return gulp.src(path.src.scripts + '**/*.js')
		.pipe(plumber(plumber_error))
		.pipe(sourcemaps.init())
		.pipe(concat('site.js'))
		// .pipe(uglify({compress: false, mangle: false}))
		.pipe(sourcemaps.write())
		.pipe(plumber.stop())
		.pipe(gulp.dest( path.dest ));
});

gulp.task('dev:watch', ['dev:build:scss', 'dev:build:js'], function() {
	gulp.watch( path.src.scripts + '*.js', { interval: 250 }, ['dev:build:js'] );
	gulp.watch( path.src.scss + '**/*.scss', { interval: 250 }, ['dev:build:scss'] );
});
