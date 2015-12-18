var elixir = require('laravel-elixir');
var livereload = require('gulp-livereload');
var gulp = require('gulp');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss','resources/assets/css/app.css');
    mix.styles([
        '../../../bower_components/HTML5-Reset/assets/css/reset.css',
        'share-button.css',
    	'app.css',
	],'public/dist/app.css');
	mix.scripts([
		'../../../bower_components/jquery/dist/jquery.js',
        '../../../bower_components/jquery.fitvids/jquery.fitvids.js',
        'share-button.js',
		'main.js',
	],'public/dist/app.js');
});

elixir(function(mix) {
    mix.scripts([
        '../../../bower_components/jquery/dist/jquery.js',
        '../../../bower_components/gsap/src/uncompressed/TweenMax.js',
    ],'public/dist/vitality_xmas.js');
});


elixir(function(mix) {
    mix.sass('admin.scss','resources/assets/css/admin.css');
    mix.styles([
    	"admin.css",
    	'../../../bower_components/Bootstrap-Admin-Theme-3/css/styles.css',
    	'../../../bower_components/Bootstrap-Admin-Theme-3/css/buttons.css',
    	'../../../bower_components/Bootstrap-Admin-Theme-3/css/calendar.css',
    	'../../../bower_components/Bootstrap-Admin-Theme-3/css/forms.css',
    	'../../../bower_components/Bootstrap-Admin-Theme-3/css/stats.css',
        '../../../bower_components/Bootstrap-Admin-Theme-3/vendors/easypiechart/jquery.easy-pie-chart.css',
        '../../../bower_components/Bootstrap-Admin-Theme-3/vendors/morris/morris.css',

	],'public/dist/admin.css');
	mix.scripts([
		'../../../bower_components/jquery/dist/jquery.js',
		'../../../bower_components/Bootstrap-Admin-Theme-3/bootstrap/js/bootstrap.js',
        '../../../bower_components/Bootstrap-Admin-Theme-3/vendors/morris/morris.js',
        // '../../../bower_components/Bootstrap-Admin-Theme-3/vendors/datatables/dataTables.bootstrap.js',
        '../../../bower_components/Bootstrap-Admin-Theme-3/vendors/easypiechart/jquery.easy-pie-chart.js',

		// '../../../bower_components/Bootstrap-Admin-Theme-3/js/calendar.js',
		// '../../../bower_components/Bootstrap-Admin-Theme-3/js/custom.js',
		// '../../../bower_components/Bootstrap-Admin-Theme-3/js/tables.js',
		'admin.js',
	],'public/dist/admin.js');
});

elixir(function(mix){
    mix.version(['dist/app.js','dist/app.css','dist/admin.js','dist/admin.css'])
});

gulp.on('task_start', function (e) {
    if (e.task === 'watch') {
        livereload.listen();
    }
});
gulp.task('watch-lr-css', function () {
    // notify a CSS change, so that livereload can update it without a page refresh
    livereload.changed('app.css');
});
gulp.task('watch-lr', function () {
    // notify any other changes, so that livereload can refresh the page
    livereload.changed('app.js');
});