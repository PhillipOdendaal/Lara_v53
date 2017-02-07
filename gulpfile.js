// gulpfile.js

// Add Elixer to mix
elixir = require('laravel-elixir');

// --- INIT
var gulp = require('gulp'),  
    less = require('gulp-less'), // compiles less to CSS
    sass = require('gulp-sass'), // compiles sass to CSS
    minify = require('gulp-minify-css'), // minifies CSS
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'), // minifies JS
    rename = require('gulp-rename'),
    phpunit = require('gulp-phpunit'),
    gp_sourcemaps = require('gulp-sourcemaps'),
    del = require('del'),
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
        'css': './public/assets/css/',
        'js': './public/assets/js/',
        'vendor': './public/assets/bower_vendor/'
    },
    'build': {
        'css': './public/build/css/',
        'js': './public/build/js/',
    },
    'public': {
        'css': './public/css/',
        'js': './public/js/',
    },
    'bower': {
        'vendor': './public/assets/bower_vendor/',
        'css': './public/assets/bower_vendor/bootstrap/less/',
        'bootstrap': './public/assets/bower_vendor/bootstrap/js/',
        'js': './public/assets/bower_vendor/jquery/dist/',

    }

};

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

// All CSS
gulp.task('style.css', function() {  
  return gulp.src([
      //paths.dev.less+'frontend.less',
      //paths.dev.less+'bootstrap.less',
      //paths.dev.less+'variables.less'
      paths.bower.css+'variables.less',
      paths.bower.css+'bootstrap.less'
  ]).pipe(less())
    .pipe(concat('style.css'))
    .pipe(gulp.dest(paths.assets.css)) // output: style.css
    .pipe(minify({keepSpecialComments:0}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.public.css)); // output: style.min.css
});

// All JS
gulp.task('app.js', function(){  
  return gulp.src([
      //paths.assets.vendor+'bootstrap-sass/assets/javascripts/bootstrap.js',
      //paths.assets.vendor+'bootstrap/dist/js/bootstrap.js',
      //paths.bower.js+'variables.less',
      
      paths.bower.js+'jquery.js',
      paths.assets.vendor+'bootstrap-sass/assets/javascripts/bootstrap.js',
    ])
    .pipe(concat('app.js'))
    .pipe(gulp.dest(paths.assets.js))
    //.pipe(gp_sourcemaps.init()) //Source map already started in build
    .pipe(uglify())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.public.js));
});

// Cleanup paths
elixir.extend('remove', function(path) {
    new elixir.Task('remove', function() {
        del(path);
    });
});
/*
// 
elixir.extend('print', function(gp_print) {
    new gulp.task('print', function() {
      gulp.src(gp_print)
       .pipe(print());
    });
});
*/
// --- WATCH
//Rerun the task when a file changes
gulp.task('watch', function() { 
    gulp.watch(paths.dev.less + '*', ['frontend.css', 'backend.css']);
    gulp.watch(paths.dev.js + '*', ['frontend.js', 'backend.js']);
});

// --- DEFAULT
// Watch default
gulp.task('default', ['app.js'], function(){});
gulp.task('default', ['style.css'], function(){});

// --- ELIXER FUNCTIONS
// Run Elixer to compile and version scripts
// Gulp
elixir(function(mix) {    
    mix.version([paths.public.css+'style.min.css', paths.public.js+'app.min.js']);
    mix.remove([ paths.public.css, paths.public.js ]);
});

// Print All
gulp.task('gp_print', function() {
  gulp.src([
      paths.dev.js+'/*.js',
      paths.dev.less+'*.less',
      paths.build.js+'/*',
      paths.build.css+'*'
  ])
    .pipe(gp_print());
});
