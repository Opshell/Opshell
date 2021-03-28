var gulp = require('gulp'),
	sass = require('gulp-sass'),
	scss_config = {
		outputStyle: 'compressed',
		indentWidth: 0
	},
	scss_list = [
		// {
		// 	'name':'opshell',
		// 	'src':'css/scss/*.scss',
		// 	'dest':'css/scss/'
		// },
		{
			'name':'webadmin',
			'src':'webadminvue/public/css/scss/*.scss',
			'dest':'webadminvue/public/css/'
		}
	],
	scss_watchs = [];

// 生成 task
scss_list.map(function(el){
	var name = 'sass:'+el.name,
		sc_conf = scss_config;

	if(typeof(el.scss) == 'object' && !Array.isArray(el.scss)){
		sc_conf = el.scss;
	}

	gulp.task(name,function() {
		return gulp.src(el.src)
			.pipe(sass(sc_conf))
			.pipe(gulp.dest(el.dest));
	});

	scss_watchs.push({
		'name':name,
		'src':el.src
	});
});

// 設定 watch
gulp.task('scss:watch', function() {
	scss_watchs.map(function(el){
		gulp.watch(el.src, gulp.series(el.name));
	});
});

// gulp初始化
gulp.task('default',gulp.parallel('scss:watch'));