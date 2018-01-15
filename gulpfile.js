// Dev dependencies required
var gulp         = require('gulp'), 
    autoprefixer = require('gulp-autoprefixer'), 
    sass         = require('gulp-sass'), 
    sourcemaps   = require('gulp-sourcemaps'), 
    imagemin     = require('gulp-imagemin'), 
    beautifycss  = require('gulp-cssbeautify'), 
    uglify       = require('gulp-uglify'), 
    htmlclean    = require('gulp-htmlclean'), 
    gutil        = require('gulp-util'), 
    rename       = require('gulp-rename'),
    concat       = require('gulp-concat'),
    plumber      = require('gulp-plumber'),
    cssmin       = require('gulp-cssmin'),
    reload       = require('browser-sync').create().reload;

// Const files required
const assets = require("./assets");
const config = require("./gulpfile-config");

// Path files
var paths = config.paths;


// HTML task
gulp.task('html', () => {
    gulp.src(paths.src.html)
        .pipe(htmlclean())
        .pipe(gulp.dest(paths.dest.html));
});

// Sass task
gulp.task('sass', () => {
    gulp.src(paths.src.sass)
        .pipe(plumber())
        .pipe(sass())
        .pipe(autoprefixer({browsers: ['last 30 versions'],cascade: false}))
        .pipe(rename({extname: ".min.css"}))
        .pipe(cssmin())
        .pipe(plumber.stop())
        .pipe(gulp.dest(paths.dest.sass))
        .pipe(beautifycss())
        .pipe(gulp.dest(paths.dest.beauty.sass))
        .pipe(reload({stream: true}));
});

// Vendor CSS task
gulp.task('css-vendor', () => {
    gulp.src(assets.css)
        .pipe(plumber())
        .pipe(concat('vendor.css'))
        .pipe(gulp.dest(paths.dest.sass))
        .pipe(rename('vendor.min.css'))
        .pipe(cssmin())
        .pipe(plumber.stop())
        .pipe(gulp.dest(paths.dest.sass))
        .pipe(reload({stream: true}));
});

// JS task
gulp.task('js', () => {
    gulp.src(paths.src.js)
        .pipe(sourcemaps.init())
        .pipe(uglify().on('error', gutil.log))
        .pipe(sourcemaps.write())
        .pipe(rename(function(file){file.extname = ".min.js";}))
        .pipe(gulp.dest(paths.dest.js))
        .pipe(reload({stream: true}));
});

// Vendor JS task
gulp.task('js-vendor', () => {
    gulp.src(assets.js)
        .pipe(plumber())
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest(paths.dest.js))
        .pipe(rename('vendor.min.js'))
        .pipe(uglify().on('error', gutil.log))
        .pipe(plumber.stop())
        .pipe(gulp.dest(paths.dest.js))
        .pipe(reload({stream: true}));
});

// Image taks
gulp.task('image', () => {
    gulp.src(paths.src.image)
        .pipe(imagemin({verbose: true}))
        .pipe(gulp.dest(paths.dest.image));
});

// Font task
gulp.task('font', () => {
    gulp.src(assets.fonts + '**/*.{eot,svg,ttf,woff,woff2}')
        .pipe(gulp.dest(paths.dest.font));
});

// Watch taks
gulp.task('watch', () => {
    gulp.watch(paths.src.html, ['html']);
    gulp.watch(paths.src.sass, ['sass']);
    gulp.watch(assets.css, ['css-vendor']);
    gulp.watch(paths.src.js, ['js']);
    gulp.watch(assets.js, ['js-vendor']);
    gulp.watch(paths.src.image, ['image']);
    gulp.watch(paths.src.font, ['font']);
});

// Default task
gulp.task('default', ['html', 'sass', 'css-vendor', 'js', 'js-vendor', 'image', 'font', 'watch']);