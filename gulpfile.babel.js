/**
 *
 *  Web Starter Kit
 *  Copyright 2015 Google Inc. All rights reserved.
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      https://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License
 *
 */

'use strict';

// This gulpfile makes use of new JavaScript features.
// Babel handles this without us having to do anything. It just works.
// You can read more about the new JavaScript features here:
// https://babeljs.io/docs/learn-es2015/

import path from 'path';
import gulp from 'gulp';
import del from 'del';
import runSequence from 'run-sequence';
import browserSync from 'browser-sync';
import swPrecache from 'sw-precache';
import gulpLoadPlugins from 'gulp-load-plugins';
import {output as pagespeed} from 'psi';
import pkg from './package.json';

const $ = gulpLoadPlugins();
const reload = browserSync.reload;

// Lint JavaScript
gulp.task('lint', () =>
  gulp.src('./themes/africa/scripts/**/*.js')
    .pipe($.eslint())
    .pipe($.eslint.format())
    .pipe($.if(!browserSync.active, $.eslint.failOnError()))
);

// Optimize images
gulp.task('images', () =>
  gulp.src('./themes/africa/src/images/**/*')
    .pipe($.imagemin({
      progressive: true,
      interlaced: true
    }))
    .pipe(gulp.dest('./themes/africa/dist/images'))
    .pipe($.size({title: './themes/africa/dist/images'}))
);

// Copy all files at the root level (app)
gulp.task('copy', () =>
  gulp.src([
    './themes/africa/src/*',
    './themes/africa/src/**/*',
    '!./themes/africa/src/styles',
    '!./themes/africa/src/styles/**/*',
    '!./themes/africa/src/scripts',
    '!./themes/africa/src/scripts/**/*',
    '!./themes/africa/src/templates',
    '!./themes/africa/src/templates/**/*',
    //'!themes/africa/*.html',
  ], {
    dot: true
  }).pipe(gulp.dest('./themes/africa/dist/'))
    .pipe($.size({title: 'copy'}))
);

// Compile and automatically prefix stylesheets
gulp.task('styles', () => {
  const AUTOPREFIXER_BROWSERS = [
    'ie >= 10',
    'ie_mob >= 10',
    'ff >= 30',
    'chrome >= 34',
    'safari >= 7',
    'opera >= 23',
    'ios >= 7',
    'android >= 4.4',
    'bb >= 10'
  ];

  // For best performance, don't add Sass partials to `gulp.src`
  return gulp.src([
    './themes/africa/src/styles/main2020-6-3.scss',
  ])
    .pipe($.newer('.tmp/styles'))
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      precision: 10
    }).on('error', $.sass.logError))
    .pipe($.autoprefixer(AUTOPREFIXER_BROWSERS))
    .pipe(gulp.dest('.tmp/styles'))
    // Concatenate and minify styles
    .pipe($.if('*.css', $.cssnano()))
    .pipe($.size({title: 'styles'}))
    .pipe($.sourcemaps.write('./'))
    .pipe(gulp.dest('./themes/africa/dist/css'));
});

// Concatenate and minify JavaScript. Optionally transpiles ES2015 code to ES5.
// to enable ES2015 support remove the line `"only": "gulpfile.babel.js",` in the
// `.babelrc` file.
gulp.task('scripts', () =>
    gulp.src([
      // Note: Since we are not using useref in the scripts build pipeline,
      //       you need to explicitly list your scripts here in the right order
      //       to be correctly concatenated
      './themes/africa/src/scripts/main.js',
      // Other scripts
      './themes/africa/src/scripts/lib/jquery-1.9.1.min.js',
      './themes/africa/src/scripts/lib/jquery.magnific-popup.min.js',
      './themes/africa/src/scripts/lib/jquery.sticky.js',
      './themes/africa/src/scripts/lib/jquery.infinitescroll.js',
      './themes/africa/src/scripts/lib/imagesloaded.js',
      './themes/africa/src/scripts/lib/isotope.pkgd.js',
      './themes/africa/src/scripts/lib/mediaelement-and-player.min.js',
      './themes/africa/src/scripts/lib/jquery.placeholder.js',
      './themes/africa/src/scripts/lib/intersection-observer.js',
      './themes/africa/src/scripts/lib/lozad.js',
      './themes/africa/src/scripts/isotope-init.js',
      './themes/africa/src/scripts/jquery.placeholder-init.js',
      './themes/africa/src/scripts/script.js'
    ])
      .pipe($.newer('.tmp/scripts'))
      .pipe($.sourcemaps.init())
      .pipe($.babel())
      .pipe($.sourcemaps.write())
      .pipe(gulp.dest('.tmp/scripts'))
      .pipe($.concat('main.min-2019.js'))
      .pipe($.uglify({preserveComments: 'some'}))
      // Output files
      .pipe($.size({title: 'scripts'}))
      .pipe($.sourcemaps.write('.'))
      .pipe(gulp.dest('./themes/africa/dist/scripts'))
);

//Scan your HTML for assets & optimize them
gulp.task('html', () => {
  return gulp.src('./themes/africa/src/templates/**/*.ss')
    .pipe($.useref({
      searchPath: '{.tmp,app}',
      noAssets: true
    }))

    // Minify any HTML
    .pipe($.if('*.ss', $.htmlmin({
      removeComments: true,
      collapseWhitespace: true,
      collapseBooleanAttributes: false,
      removeAttributeQuotes: false,
      removeRedundantAttributes: true,
      removeEmptyAttributes: true,
      removeScriptTypeAttributes: true,
      removeStyleLinkTypeAttributes: true,
      removeOptionalTags: false
    })))
    // Output files
    .pipe($.if('*.ss', $.size({title: 'ss', showFiles: true})))
    .pipe(gulp.dest('./themes/africa/templates/'));
});

// Clean output directory
gulp.task('clean', () => del(['.tmp', './themes/africa/dist/*', '!dist/.git'], {dot: true}));

// Watch files for changes & reload
gulp.task('watch', ['styles', 'html'], () => {
  // gulp.watch(['./themes/africa/**/*.html'], reload);
  gulp.watch(['./themes/africa/src/templates/**/*.ss'], ['html']);
  gulp.watch(['./themes/africa/src/styles/**/*.{scss,css}'], ['styles']);
  gulp.watch(['./themes/africa/src/scripts/**/*.js'], ['lint', 'scripts']);
  gulp.watch(['./themes/africa/src/images/**/*']);
});


// Build production files, the default task
gulp.task('default', ['clean'], cb =>
  runSequence(
    'styles',
    ['lint', 'scripts', 'images', 'copy'],
    'watch',
    cb
  )
);