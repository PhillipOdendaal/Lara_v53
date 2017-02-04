// gulpfile.js

// --- INIT
var gulp = require('gulp'),  
    less = require('gulp-less'), // compiles less to CSS
    sass = require('gulp-sass'), // compiles sass to CSS
    minify = require('gulp-minify-css'), // minifies CSS
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'), // minifies JS
    rename = require('gulp-rename'),
    phpunit = require('gulp-phpunit'),
    //countWord = require('gulp-count-stat'),
    //count = require('gulp-count'),
    //coffee = require('coffee-gulp');
    gp_sourcemaps = require('gulp-sourcemaps'),
    gp_print = require('gulp-print');

// Paths variables
var paths = {  
    'dev': {
        'less': './public/dev/less/',
        'scss': './public/dev/scss/',
        'js': './public/dev/js/',
        'vendor': './public/dev/vendor/'
    },
    'assets': {
        //'css': './Tangent_v2/public/assets/css/',
        'css': './public/css/',
        //'js': './Tangent_v2/public/assets/js/',
        'js': './public/js/',
        'vendor': './public/assets/bower_vendor/'
    }

};

//var count = require('gulp-count');

// Adding Elixer to mix
//var elixir = require('laravel-elixir');
//var webpack = require('laravel-elixir-webpack');
elixir = require('laravel-elixir');
webpack = require('laravel-elixir-webpack');

// --- TASKS
// CSS frontend
gulp.task('frontend.css', function() {  
  // place code for your default task here
  return gulp.src(paths.dev.less+'frontend.less') // get file
    .pipe(less())
    .pipe(gulp.dest(paths.assets.css)) // output: frontend.css
    .pipe(minify({keepSpecialComments:0}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.assets.css)); // output: frontend.min.css
});

// CSS backend
gulp.task('backend.css', function() {  
  // place code for your default task here
  return gulp.src(paths.dev.less+'backend.less') // get file
    .pipe(less())
    .pipe(gulp.dest(paths.assets.css)) // output: backend.css
    .pipe(minify({keepSpecialComments:0}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.assets.css)); // output: backend.min.css
});

// JS frontend
gulp.task('frontend.js', function(){  
  return gulp.src([
      paths.assets.vendor+'jquery/dist/jquery.js',
      paths.assets.vendor+'bootstrap/dist/js/bootstrap.js',
      paths.dev.js+'frontend.js'
    ])
    .pipe(concat('frontend.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest(paths.assets.js));
});

// JS backend
gulp.task('backend.js', function(){  
  return gulp.src([
      paths.assets.vendor+'jquery/dist/jquery.js',
      paths.assets.vendor+'bootstrap/dist/js/bootstrap.js',
      paths.dev.js+'backend.js'
    ])
    .pipe(gp_sourcemaps.init())
    .pipe(concat('backend.min.js'))
    .pipe(gulp.dest(paths.assets.js))
    .pipe(uglify())
    .pipe(gulp.dest(paths.assets.js));
});



gulp.task('gp_print', function() {
  gulp.src([
      paths.dev.js+'/*.js',
      paths.dev.less+'*.less'
  ])
    .pipe(gp_print());
});

// All CSS
gulp.task('style.css', function() {  
  return gulp.src([
      paths.dev.less+'frontend.less',
      paths.dev.less+'bootstrap.less'
  ]).pipe(less())   
    .pipe(concat('style.css'))
    .pipe(gulp.dest(paths.assets.css)) // output: style.css
    .pipe(minify({keepSpecialComments:0}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.assets.css)); // output: style.min.css
});
// All JS
gulp.task('app.js', function(){  
  return gulp.src([
      paths.assets.vendor+'jquery/dist/jquery.js',
      paths.assets.vendor+'bootstrap/dist/js/bootstrap.js',
    ])
    .pipe(gp_sourcemaps.init())
    .pipe(concat('app.js'))
    .pipe(gulp.dest(paths.assets.js))
    .pipe(uglify())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.assets.js));
});

// PHP unit
/**
gulp.task('phpunit', function() {  
  var options = {debug: false, notify: false};
  return gulp.src('./laravel/app/tests/*.php')
    .pipe(phpunit('./laravel/vendor/bin/phpunit', options))
    // .pipe(phpunit())

    //both notify and notify.onError will take optional notifier: growlNotifier for windows notifications
    //if options.notify is true be sure to handle the error here or suffer the consequenses!
    .on('error', notify.onError({
      title: 'PHPUnit Failed',
      message: 'One or more tests failed, see the cli for details.'
    }))

        //will fire only if no error is caught
    .pipe(notify({
      title: 'PHPUnit Passed',
      message: 'All tests passed!'
    }));
});
**/

// --- WATCH
//Rerun the task when a file changes
gulp.task('watch', function() { 
    gulp.watch(paths.dev.less + '*', ['frontend.css', 'backend.css']);
    gulp.watch(paths.dev.js + '*', ['frontend.js', 'backend.js']);
});

// --- DEFAULT
// 
gulp.task('default', ['app.js'], function(){});
gulp.task('default', ['style.css'], function(){});
// Run Elixer to compile and version scripts
/**
elixir(function(mix) {
    mix.less('frontend.less', 'public/css/app.css');
});
elixir(function(mix) {
    mix.webpack('app.js','./public/js');
});
**/
elixir(function(mix) {
    mix.version([paths.assets.css+'style.min.css', paths.assets.js+'app.min.js']);
});