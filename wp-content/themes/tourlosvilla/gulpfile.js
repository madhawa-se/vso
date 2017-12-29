// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify');
var rename = require('gulp-rename');
var cleanCSS = require('gulp-clean-css');

var sassruby = require('gulp-ruby-sass');
var sass = require('gulp-sass');
var scss = require('gulp-scss');
var sourcemaps = require('gulp-sourcemaps');
var runSequence = require('run-sequence');

var mysqlDump = require('mysqldump');

// Concatenate & Minify JS
gulp.task('scripts', function () {
    return gulp.src([
        'css/jquery-ui-1.11.2.custom/jquery-ui.js',
        'js/jquery.backstretch__seoalt.js',
        'js/modernizr.js',
        'js/bootstrap.min.js',
        'js/fancybox/jquery.fancybox.pack.js',
        'js/wow.js',
        'js/jquery.stellar.js',
        'js/plugins.js',
        'js/scripts.js'
    ])
            .pipe(concat('js/all-unc.js'))
            .pipe(gulp.dest('.'))
            .pipe(uglify())
            .pipe(rename('js/all.min.js'))
            .pipe(gulp.dest('.'));
});

// Concatenate & Minify CSS
gulp.task('styles', function () {
    return gulp.src([
        'js/fancybox/jquery.fancybox.css',
        'css/jquery-ui-1.11.2.custom/jquery-ui.css',
        'css/bootstrap.css',
        'css/styles.css'
    ])
            .pipe(concat('css/all-unc.css'))
            .pipe(gulp.dest('.'))
            .pipe(cleanCSS({keepSpecialComments: 0}))
            .pipe(rename('css/all.min.css'))
            .pipe(gulp.dest('.'));
});

// Watch Files For Changes
gulp.task('watch', function () {
    gulp.watch('js/*.js', ['scripts']);
    gulp.watch('scss/*.scss', ['css']);
});

//compile sass into css
gulp.task('scss-ruby', function () {
    return sassruby([
        './scss/*.scss',
        '!./scss/_*.scss'
    ], {sourcemap: true})
            .on('error', sassruby.logError)
            .pipe(sourcemaps.write())
            .pipe(sourcemaps.write('./', {
                includeContent: false,
                sourceRoot: './scss'
            }))
            .pipe(gulp.dest('./css'));
});

gulp.task('css', function (done) {
    runSequence('scss-ruby', 'styles', function () {
        console.log('scss compiled');
        done();
    });
});
gulp.task('dumpdb', function () {
    mysqlDump({
        host: 'localhost',
        user: 'root',
        password: '',
        database: 'villamyk_main',
        ifNotExist: false, // Create table if not exist 
        dest: './database2.sql' // destination file 
    }, function (err) {
        // create data.sql file; 
        //  console.error(err);
    });
});
// Default Task
gulp.task('default', ['css']);