var gulp = require('gulp');
var bs = require('browser-sync').create();
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');

//	tasks
gulp.task('serve', ['sass'], function () {
	bs.init({
		proxy: "localhost:8000",
		serveStatic: [{
			route: '/node_modules',
			dir: 'node_modules'
		}],
		files: "web/css/*.css"
	});

	gulp.watch('src/CoreBundle/Resources/config/**/*.scss', ['sass']);
	gulp.watch('src/UserBundle/Resources/views/*.html*').on('change', bs.reload);

});

gulp.task('jsConcat', function () {
	return gulp.src('src/CoreBundle/Resources/config/js/*.js')
		.pipe(sourcemaps.init())
		.pipe(concat('all.js'))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('src/CoreBundle/Resources/config/dist'));
});

gulp.task('sass', function() {
	return gulp.src('src/**/*/main.scss')
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(concat('main.css'))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest("web/css/"))
		.pipe(bs.stream());
});

gulp.task('default', ['serve', 'jsConcat']);