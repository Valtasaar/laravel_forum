/*'use strict';

var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');
require('laravel-elixir-browserify-official');

elixir(function(mix) {
    mix.webpack('app.js', 'public/js/web.js');
});*/
/*
'use strict';

var gulp = require('gulp'),
    concat = require('gulp-concat'),
    watch = require('gulp-watch'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    uglifycss = require('gulp-uglifycss'),
    debug = require('gulp-debug'),
    stylus = require('gulp-stylus'),
    sourcemaps = require('gulp-sourcemaps'),
    fileinclude = require('gulp-file-include'),
    plumber = require('gulp-plumber'),
    notify = require('gulp-notify'),
    rjs = require('gulp-requirejs'),
    vueify = require('gulp-vueify'),
    babel = require('gulp-babel'),
    requireFile = require('gulp-require-file'),
    webpack = require('webpack-stream'),
    gulpsync = require('gulp-sync')(gulp),
    vueModule = require('gulp-vue-module');

// Paths
var resources = 'resources/assets';

gulp.task('styles', function() {
    gulp.src(resources + '/stylus/index.styl')
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(stylus())
        .pipe(sourcemaps.write())
        .pipe(concat('styles.css'))
        .pipe(gulp.dest('public/css'))
        .pipe(rename('styles.min.css'))
        .pipe(uglifycss())
        .pipe(gulp.dest('public/css'))
});

gulp.task('vue', function() {
    gulp.src(resources + '/js/vue/!**!/!*.vue')
        .pipe(plumber())
        .pipe(vueModule())
        .pipe(concat('vue.js'))
        .pipe(gulp.dest('public/js'))
        .on('error', notify.onError());
});

gulp.task('scripts', function() {
    gulp.src(resources + '/js/app.js')
        .pipe(plumber())
        .pipe(webpack({
            module: {
                rules: [
                    {
                        test: /\.js$/,
                        use: {
                            loader: 'babel-loader',
                            options: {
                                presets: ['es2015'],
                                compact: false,
                                plugins: ['transform-object-rest-spread']
                            }
                        }
                    },
                    /!*{
                        test: /\.vue$/,
                        loader: 'vue-loader',
                        exclude: /bower_components/,
                        options: {
                            // extractCSS: Config.extractVueStyles,
                            loaders: {
                                js: {
                                    loader: 'babel-loader',
                                    options: {
                                        presets: [
                                            ['env', {
                                                'modules': false,
                                                'targets': {
                                                    'browsers': ['> 2%'],
                                                    uglify: true
                                                }
                                            }]
                                        ],
                                        plugins: ['transform-object-rest-spread']
                                    }
                                }
                            }
                        }
                    }*!/
                ]
            },
            /!*resolve: {
                alias: {
                    vue: 'vue/dist/vue.js'
                }
            }*!/
        }))
        .pipe(concat('app.js'))
        .pipe(gulp.dest('public/js'))
        .on('error', notify.onError());
});

gulp.task('libs-js-concat', function() {
    gulp.src('resources/libs/libs-scripts.js')
        .pipe(fileinclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(concat('libs-scripts.js'))
        .pipe(gulp.dest('public/js'))
        .pipe(rename('libs-scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/js'));
});

gulp.task('libs-css-concat', function() {
    gulp.src('resources/libs/libs-styles.css')
        .pipe(fileinclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(concat('libs-styles.css'))
        .pipe(gulp.dest('public/css'))
        .pipe(rename('libs-styles.min.css'))
        .pipe(uglifycss())
        .pipe(gulp.dest('public/css'));
});

gulp.task('minimg', function() {
    gulp.src(['resources/img/header/!*',
            'resources/img/ref_slider/!*',
            'resources/img/work_slider/!*',
            'resources/img/!*'],
        {base: 'resources/'})
        .pipe(imagemin([imageminJpegtran({
            progressive: true
        })], {
            verbose: true
        }))
        .pipe(gulp.dest('public/'));
});

gulp.task('svgSprite', function() {
    gulp.src('resources/img/icons/svg/!*.svg')
        .pipe(svgmin({
            js2svg: {
                pretty: true
            }
        }))
        .pipe(cheerio({
            run: function ($) {
                $('[fill]').removeAttr('fill');
                $('[stroke]').removeAttr('stroke');
                $('[style]').removeAttr('style');
            },
            parserOptions: {xmlMode: true}
        }))
        .pipe(replace('&gt;', '>'))
        .pipe(svgSprite({
            mode: {
                symbol: {
                    sprite: "../sprite.svg",
                    render: {
                        styl: {
                            dest:'../../../../resources/stylus/sprite.styl',
                            template: 'resources/stylus/sprite_template.styl'
                        }
                    }
                }
            }
        }))
        .pipe(gulp.dest('public/img/icons/'));
});

gulp.task('watch', function() {
    gulp.watch(resources + '/js/!**!/!*.*', ['scripts']);
});

gulp.task('default', ['scripts', 'watch']);
*/
