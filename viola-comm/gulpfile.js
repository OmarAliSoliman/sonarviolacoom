const
    { gulp, series, parallel, src, dest, watch } = require('gulp'),
    del = require('del'),
    dir = {
        src: 'src/*.html',
        build: 'build/',
        partials: 'src/partials/',
        scss: 'scss/*.scss',
        css: 'css/'
    },
    htmlPartial = require('gulp-html-partial'),
    sourcemaps = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer'),
    rtlcss = require('gulp-rtlcss'),
    rename = require("gulp-rename"),
    watchSass = require("gulp-watch-sass"),
    sass = require("gulp-sass"),

    image = require('gulp-image');


function clean() {
    return del([dir.build]);
}

function compileSass(done) {
    src(dir.scss)
        // .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        // .pipe(sourcemaps.write('.'))
        .pipe(dest('build/css/'))
        .pipe(src('css/*.css'))
        //.pipe(dest('css')) // Output LTR stylesheets.
        .pipe(rtlcss()) // Convert to RTL.
        .pipe(rename({
            suffix: '-rtl'
        }))// Append "-rtl" to the filename.
        .pipe(dest('build/css/rtl'));
    done()
}
function html() {
    return src(dir.src)
        .pipe(htmlPartial({
            basePath: dir.partials
        }))
        .pipe(dest(dir.build));
}
function copyJS() {
    return src('js/**/*')
        .pipe(dest('build/js'));
}
function copyCSS() {
    return src('css/**/*')
        .pipe(dest('build/css'));
}
function compileCss(done) {
    return src(dir.css + '*.css', { base: 'css' })
        .pipe(dest('css')) // Output LTR stylesheets.
        .pipe(rtlcss()) // Convert to RTL.
        .pipe(rename({
            suffix: '-rtl'
        })) // Append "-rtl" to the filename.
        .pipe(dest('build/css')); // Output RTL stylesheets.
    done();
}
function imageMin() {
    return src('build/img/**/*').pipe(image({
        pngquant: true,
        optipng: true,
        zopflipng: true,
        jpegRecompress: true,
        mozjpeg: true,
        gifsicle: true,
        svgo: true,
        concurrent: 10,
        quiet: true // defaults to false
    })).pipe(dest('build/img'))
}
watch('scss/*.scss', compileSass);
// watch('css/*.css', compileCss);
watch('src/**/*.html', html);
// watch('js/**/*.html', copyJS);
watch('img/**/*', imageMin);
const build = series(
    // clean,
    html,
    // imageMin,
    compileSass,
    copyCSS,
    // copyJS
    // compileCss
)
exports.html = html;
exports.compileSass = compileSass;
exports.imageMin = imageMin;
exports.compileCss = compileCss;
exports.default = build;

