import gulp from 'gulp';
import sass from 'gulp-sass';
import nodesass from 'node-sass';
import rename from 'gulp-rename';
import sourcemaps from 'gulp-sourcemaps';
import fs from 'fs';
import path from 'path';

sass.compiler = nodesass;

gulp.task('sass', () => {
  return gulp.src('sass/**/*.scss')
    .pipe(sourcemaps.init()) // TODO: Change to dev env only
    .pipe(sass().on('error', sass.logError))
    .pipe(sass({
      outputStyle: 'expanded'
    }))
    .pipe(rename((function (path) {
        path.extname = ".min.css";
    })))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('css/'));
});

gulp.task('sass:watch', () => {
  gulp.watch('sass/**/*.scss', gulp.series(['sass']));
});
