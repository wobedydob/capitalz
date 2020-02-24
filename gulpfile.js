// Run 'gulp sass:watch' in de terminal om scss veranderingen te compilen naar css

'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
sass.compiler = require('node-sass');

gulp.task('sass', function () {
    return gulp.src('style/scss/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('style/css'));
});
gulp.task('sass:watch', function () {
    gulp.watch('style/scss/**/*.scss', gulp.series('sass'));
});