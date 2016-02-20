var gulp = require('gulp');
var less = require('gulp-less');
var elixir = require('laravel-elixir');
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
var publicPath = "public";
var nodePath = "node_modules";
var vendorPath = publicPath + "/assets/vendor";
var paths = {
    jquery: {
        src: nodePath + "/jquery/dist/jquery.min.js",
        dest: vendorPath + "/jquery"
    },
    jqueryui: {
        src: nodePath + "/jquery-ui",
        dest: vendorPath + "/jquery-ui"
    },
    bootstrap: {
        src: nodePath + "/bootstrap/**/*",
        dest: vendorPath + "/bootstrap"
    },
    fontawesome: {
        src: nodePath + "/font-awesome/**/*",
        dest: vendorPath + "/font-awesome"
    },
    moment: {
        src: nodePath + "/moment/**/*",
        dest: vendorPath + "/moment"
    },
    eonasdan_bootstrap_datetimepicker: {
        src: nodePath + "/eonasdan-bootstrap-datetimepicker/src/js/*.js",
        dest: vendorPath + "/bootstrap-datetimepicker"
    }
};


gulp.task('build-less', function(){
    return gulp.src(nodePath + '/eonasdan-bootstrap-datetimepicker/src/less/bootstrap-datetimepicker-build.less')
        .pipe(less())
        .pipe(gulp.dest('public/assets/vendor/bootstrap-datetimepicker'));
});

elixir(function(mix) {
    //mix.copy(paths.jquery.src, paths.jquery.dest);
    //mix.copy(paths.moment.src, paths.moment.dest);
    //mix.copy(paths.bootstrap.src, paths.bootstrap.dest);
    //mix.copy(paths.fontawesome.src, paths.fontawesome.dest);
    //mix.copy(paths.eonasdan_bootstrap_datetimepicker.src, paths.eonasdan_bootstrap_datetimepicker.dest);
    mix.sass('app.scss');
    mix.sass('public/app.scss', './public/css/public/app.css');
});