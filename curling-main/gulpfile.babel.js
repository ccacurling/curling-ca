import gulp from 'gulp';

// SASS
import sass from 'gulp-sass';
import nodesass from 'node-sass';
import rename from 'gulp-rename';
import sourcemaps from 'gulp-sourcemaps';

// Rollup
import rollup from 'gulp-better-rollup';
import babel from 'rollup-plugin-babel';
import resolve from "rollup-plugin-node-resolve";
import commonjs from "rollup-plugin-commonjs";
import { uglify } from "rollup-plugin-uglify";

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
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('css/'));
});

gulp.task('rollup', () => {
  return gulp.src(['js/main.js', 'js/blocks/*.js'])
    .pipe(sourcemaps.init()) // TODO: Change to dev env only
    .pipe(rollup({
      plugins: [
        resolve({
          browser: true,
          mainFields: ["jsnext:main"]
        }),
        babel({
          exclude: "dist/**",
          presets: ["@babel/env", "@babel/preset-react"]
        }),
        commonjs(),
        uglify()
      ]
    }, {
      name: 'main',
      format: 'cjs',
    }))
    .pipe(rename((function (path) {
      path.extname = ".min.js";
    })))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('js/dist'))
});

gulp.task('sass:watch', () => {
  gulp.watch('sass/**/*.scss', gulp.series(['sass']));
});

gulp.task('rollup:watch', () => {
  gulp.watch(['js/**/*.js', '!js/dist/**/*.js', '!js/vendor/**/*.js'], gulp.series(['rollup']));
});
