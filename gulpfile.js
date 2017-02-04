// gulpfile.js

// --- INIT
var gulp = require('gulp'),  
    less = require('gulp-less'), // compiles less to CSS
    sass = require('gulp-sass'), // compiles sass to CSS
    minify = require('gulp-minify-css'), // minifies CSS
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'), // minifies JS
    rename = require('gulp-rename'),
    phpunit = require('gulp-phpunit');

// Paths variables
var paths = {  
    'dev': {
        'less': './Tangent_v2/public/dev/less/',
        'scss': './Tangent_v2/public/dev/scss/',
        'js': './Tangent_v2/public/dev/js/',
        'vendor': './Tangent_v2/public/dev/vendor/'
    },
    'assets': {
        'css': './Tangent_v2/public/assets/css/',
        'js': './Tangent_v2/public/assets/js/',
        'vendor': './Tangent_v2/public/assets/bower_vendor/'
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
    .pipe(concat('backend.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest(paths.assets.js));
});

// PHP unit
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
// --- WATCH
//Rerun the task when a file changes
gulp.task('watch', function() {  
  gulp.watch(paths.dev.less, ['frontend.css', 'backend.css']);
  gulp.watch(paths.dev.js, ['frontend.js', 'backend.js']);
});

// --- DEFAULT

