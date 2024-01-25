const gulp = require('gulp');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const browserSync = require('browser-sync').create();
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const sourcemaps = require('gulp-sourcemaps');
const imagemin = require('gulp-imagemin');
const pngquant = require('imagemin-pngquant');
const webp = require('gulp-webp');
const changed = require('gulp-changed');
const uglify = require('gulp-uglify-es').default;
const browserify = require('gulp-browserify');
const lineec = require('gulp-line-ending-corrector');

const root = `./`;
const assets = `${root}assets/`;
const src = `${assets}src/`;
const dist = `${assets}dist/`;
const scss = `${src}scss/`;
const css = `${src}css/`;
const cssDEST = `${dist}css/`;
const js = `${src}js/`;
const jsVendorSRC = `${js}vendor/*.js`;
const jsModuleSRC = `${js}modules/*.js`;
const jsDEST = `${dist}js/`;
const jsVendorDEST = `${dist}js/vendor/`;
const jsModuleDEST = `${dist}js/modules/`;
const imgSRC = `${src}img/**/*`;
const imgSRCwebp = `${src}img/**/*.{jpg,png}`;
const imgDEST = `${dist}img/`;
const fontsSRC = `${src}fonts/**/*`;
const fontsDEST = `${dist}fonts/`;
const phpWatchFiles = `${root}**/*.php`;
const styleWatchFiles = `${root}**/*.scss`;

function compileSCSS() {
	return gulp.src(`${scss}*.scss`)
		.pipe(sourcemaps.init({
			loadMaps: true,
		}))
		.pipe(sass({
			outputStyle: 'compressed',
		}).on('error', sass.logError))
		.pipe(sourcemaps.write(''))
		.pipe(lineec())
		.pipe(gulp.dest(css));
}

function copyCSS() {
	const plugins = [
		autoprefixer({
			overrideBrowserslist: ['last 2 versions'],
		}),
	];

	return gulp.src(`${css}*.css`)
		.pipe(sourcemaps.init({
			loadMaps: true,
			largeFile: true,
		}))
		.pipe(postcss(plugins))
		.pipe(cleanCSS({
			level: {
				1: {},
			},
		}))
		.pipe(sourcemaps.write(''))
		.pipe(gulp.dest(cssDEST));
}

function copyJS() {
	return gulp.src(`${js}*.js`)
		.pipe(sourcemaps.init({
			loadMaps: true,
			largeFile: true,
		}))
		.pipe(browserify({
			debug: true,
		}))
		.pipe(uglify())
		.pipe(sourcemaps.write(''))
		.pipe(lineec())
		.pipe(gulp.dest(jsDEST));
}

function copyModuleJS() {
	return gulp.src(jsModuleSRC)
		.pipe(sourcemaps.init({
			loadMaps: true,
			largeFile: true,
		}))
		.pipe(browserify({
			debug: true,
			transform: 'babelify'
		}))
		.pipe(uglify())
		.pipe(sourcemaps.write(''))
		.pipe(lineec())
		.pipe(gulp.dest(jsModuleDEST));
}

function copyVendorJS() {
	return gulp.src(jsVendorSRC)
		.pipe(sourcemaps.init({
			loadMaps: true,
			largeFile: true,
		}))
		.pipe(uglify())
		.pipe(sourcemaps.write(''))
		.pipe(lineec())
		.pipe(gulp.dest(jsVendorDEST));
}

function imgmin() {
	return gulp.src(imgSRC)
		.pipe(changed(imgDEST))
		.pipe(imagemin([
			imagemin.gifsicle({
				interlaced: true,
			}),
			imagemin.mozjpeg({
				progressive: true,
			}),
			pngquant({
				speed: 1,
			}),
			imagemin.svgo({
				removeViewBox: false,
			}),
		]))
		.pipe(gulp.dest(imgDEST));
}

function convertWebp() {
	return gulp.src(imgSRCwebp)
		.pipe(webp())
		.pipe(gulp.dest(imgDEST));
}

function copy() {
	return gulp.src(`${src}img/svg/*`)
		.pipe(gulp.dest(`${imgDEST}svg/`));
}

function copyFonts() {
	return gulp.src(fontsSRC)
		.pipe(gulp.dest(fontsDEST));
}

function watch() {
	browserSync.init({
		open: 'external',
		proxy: 'http://localhost:8888',
	});
	gulp.watch(styleWatchFiles, gulp.series([compileSCSS, copyCSS]));
	gulp.watch(`${js}**/*`, copyJS);
	gulp.watch(`${js}**/*`, copyModuleJS);
	gulp.watch(`${js}**/*`, copyVendorJS);
	gulp.watch(imgSRC, imgmin);
	gulp.watch(imgSRC, convertWebp);
	gulp.watch(imgSRC, copy);
	gulp.watch(fontsSRC, copyFonts);
	gulp.watch([phpWatchFiles, `${cssDEST}*.css`, `${jsDEST}*.js`, `${jsModuleDEST}*.js`, `${jsVendorDEST}*.js`, `${imgDEST}*`, `${fontsDEST}*`]).on('change', browserSync.reload);
}

function build() {
	return gulp.series(
		compileSCSS,
		copyCSS,
		copyJS,
		copyModuleJS,
		copyVendorJS,
		imgmin,
		convertWebp,
		copy,
		copyFonts,
	);
}

exports.compileSCSS = compileSCSS;
exports.copyCSS = copyCSS;
exports.copyJS = copyJS;
exports.copyModuleJS = copyModuleJS;
exports.copyVendorJS = copyVendorJS;
exports.imgmin = imgmin;
exports.convertWebp = convertWebp;
exports.copy = copy;
exports.copyFonts = copyFonts;
exports.watch = watch;

const run = gulp.parallel(watch);
gulp.task('default', run);
gulp.task('build', build());
