const gulp = require('gulp');
const sass = require('gulp-sass');
const browserSync = require('browser-sync').create();
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var cssnano = require('cssnano');


gulp.task('sass', function () {
  return gulp.src('./sass/style.scss')
    .pipe(sass())
    .pipe(gulp.dest('./'))
    .pipe(browserSync.stream())
    .pipe(browserSync.reload({stream: true}));
});

gulp.task('serve', function() {

    browserSync.init({
    proxy: "http://localhost:8888"
    });

    gulp.watch("./sass/*/*.scss", ['sass']);
    gulp.watch("./**/*.php").on('change', browserSync.reload);
});

gulp.task('css', function () {
    var plugins = [
        autoprefixer({browsers: ['last 10 versions']}),
        cssnano()
    ];
    return gulp.src('./*.css')
        .pipe(postcss(plugins))
        .pipe(gulp.dest('./'));
});


gulp.task('default', ['sass', 'serve', 'css']);