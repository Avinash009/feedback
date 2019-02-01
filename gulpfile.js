/*global -$ */
"use strict";

var gulp        = require("gulp");
var bundle      = require("gulp-bundle-assets");
var flatten     = require("gulp-flatten");
var gulpIf      = require("gulp-if");
var babel       = require("gulp-babel");
var uglify      = require("gulp-uglify");
var cleanCSS    = require('gulp-clean-css');

gulp.task("bundle", function () {
  return gulp.src("./bundle.config.js")
    .pipe(bundle())
    .pipe(flatten())
    .pipe(gulpIf(/app\.js$/, babel({
      presets: ['es2015']
    })))
  .pipe(gulpIf(['*.css'],cleanCSS({processImport: false})))
    .pipe(gulpIf(['*.js'], gulp.dest("./public/js/") ))
    .pipe(gulpIf(['*.css'], gulp.dest("./public/css/") ))
});

gulp.task("move", function () {
  gulp.src(["./background/assets/img/**/*"]).pipe(gulp.dest("./public/img"))
  
  gulp.src(["./background/assets/fonts/**/*"]).pipe(gulp.dest("./public/fonts"))
  gulp.src(["./node_modules/font-awesome/fonts/**/*"]).pipe(gulp.dest("./public/fonts"))
});


gulp.task("watch", function () {
  gulp.start('bundle');
  gulp.start('move');

  gulp.watch(["./background/assets/js/**/*", "./background/assets/css/**/*"],['bundle']);

  gulp.watch(["./background/assets/fonts/**/*",
      "./background/assets/img/**/*",
  ], ['move']);

});

gulp.task("default", ["bundle","move"]);
