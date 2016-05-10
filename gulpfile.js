//var elixir = require('laravel-elixir');
var gulp = require('gulp');
var less = require('gulp-less');

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

//elixir(function (mix) {
//    mix.sass('app.scss');
//});

gulp.task('default', function () {
    gulp.src('resources/admin/less/style.less')
        .pipe(less())
        .pipe(gulp.dest('resources/admin/assets/css'));
});
