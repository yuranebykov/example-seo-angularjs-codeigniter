var gulp = require('gulp');
var browserSync = require('browser-sync');
var less = require('gulp-less');
var reload = browserSync.reload;

gulp.task('serve', function() {
	browserSync({
		host: '10.0.0.196'
	});

	gulp.watch('resources/less/*.less', ['less']);
	gulp.watch(['application/controllers/*.php', 'application/views/*.php']).on('change', reload);
    gulp.watch(['assets/partials/*.html']).on('change', reload);
    gulp.watch(['assets/js/*.js']).on('change', reload);
});

gulp.task('less', function() {
	return gulp.src('./resources/less/*.less')
	.pipe(less())
	.pipe(gulp.dest('./assets/css'))
	.pipe(reload({stream: true}));
});

gulp.task('default', ['serve', 'less']);