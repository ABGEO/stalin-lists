const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const open = require('gulp-open');

const paths = {
    HERE: './',
    DIST: 'dist/',
    CSS: './assets/css/',
    SCSS_TOOLKIT_SOURCES: './assets/scss/material-kit.scss',
    SCSS: './assets/scss/**/**'
};

gulp.task('compile-scss', function () {
    return gulp.src(paths.SCSS_TOOLKIT_SOURCES)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write(paths.HERE))
        .pipe(gulp.dest(paths.CSS));
});

gulp.task('watch', function () {
    gulp.watch(paths.SCSS, gulp.series('compile-scss'));
});

gulp.task('open', function () {
    gulp.src('elements.html')
        .pipe(open());
});

gulp.task('open-app', gulp.parallel('open', 'watch'));
