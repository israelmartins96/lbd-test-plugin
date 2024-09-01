/**
 * Using Gulp 5.
 */

/**
 * Modules.
 */
// Gulp.
import gulp from 'gulp';

// Gulp Rename for modifying file name.
import rename from 'gulp-rename';

// Sass CSS compiler.
import * as dartSass from 'sass';
import gulpSassModule from 'gulp-sass';

const gulpSass = gulpSassModule( dartSass );

// Gulp Autoprefixer for adding CSS vendor prefixes.
import autoprefixer from 'gulp-autoprefixer';

// Gulp Uglify.
import uglify from 'gulp-uglify';

// Gulp Sourcemaps.
import * as sourcemaps from 'gulp-sourcemaps';

// Browserify.
import browserify from 'browserify';

// Babelify.
import babelify from 'babelify';

// Vinyl Source Stream.
import source from 'vinyl-source-stream';

// Vinyl Buffer.
import buffer from 'vinyl-buffer';

// Browser Sync.
import theBrowserSync, { watch } from 'browser-sync';

const browserSync = theBrowserSync.create();
// BrowserSync Reload.
const reload = browserSync.reload;

/**
 * Files sources and destinations.
 */
const paths = {
    projectURL: 'http://127.0.0.1/wordpress/plugindevt/',
    current: '.',
    styles: {
        src: {
            main: 'src/scss/style.scss',
            dir: 'src/scss/',
            files: [
                'style.scss'
            ]
        },
        dest: './assets/css/',
        admin: {
            src: 'src/admin/scss/style.scss',
            dir: 'src/admin/scss/',
            files: [
                'style.scss'
            ],
            dest: './assets/admin/css/'
        },
        watch: 'src/**/*.scss'
    },
    scripts: {
        src: {
            main: 'src/js/script.js',
            dir: 'src/js/',
            files: [
                'script.js'
            ]
        },
        dest: './assets/js/',
        admin: {
            src: 'src/admin/js/script.js',
            dir: 'src/admin/js/',
            files: [
                'script.js'
            ],
            dest: './assets/admin/js/'
        },
        watch: 'src/**/*.js'
    },
    php: {
        watch: './**/*.php'
    }
};

/**
 * Tasks data.
 */
// Tasks list.
const tasksList = {
    default: 'default',
    style: 'style',
    js: 'js',
    watch: 'watch',
    browserSync: 'browser-sync'
};

// Default tasks.
const tasksDefault = [
    tasksList.style,
    tasksList.js,
    tasksList.watch,
    tasksList.browserSync
];

/**
 * Compiles stylesheet with sourcemap enabled.
 * 
 * @param {*} src style source file.
 * @param {*} dest style output location.
 */
const loadStyle = ( src, dest ) => {
    gulp.src( src, { sourcemaps: true } )
    // Render CSS in minified form.
    .pipe( gulpSass( {
        errorLogToConsole: true,
        outputStyle: 'compressed'
    } ) )
    // Log errors in the console if any during the CSS rendering.
    .on( 'error', console.error.bind( console ) )
    // Add browser vendor CSS prefixes.
    .pipe( autoprefixer( {
        cascade: false
    } ) )
    // Add the ".min" suffix to the file name.
    .pipe( rename( { suffix: '.min' } ) )
    // Render the CSS file in the CSS directory with external sourcemaps.
    .pipe( gulp.dest( dest, { sourcemaps: '.' } ) )
    // Add BrowserSync stream.
    .pipe( browserSync.stream() );
};

/**
 * Compiles stylesheets.
 */
const loadStyles = async () => {
    loadStyle( paths.styles.src.main, paths.styles.dest );
    loadStyle( paths.styles.admin.src, paths.styles.admin.dest );
};

/**
 * Maps scripts.
 */
const mapScripts = ( entryScript, src, dest ) => {
    // Browserify.
    return browserify()
        // Transform babelify.
        .transform( babelify )
        // Make source file available.
        .require( src, { entry: true } )
        // Bundle.
        .bundle()
        // Check source.
        .pipe( source( entryScript ) )
        // Add ".min" file name suffix.
        .pipe( rename( { extname: '.min.js' } ) )
        // Buffer.
        .pipe( buffer() )
        // Sourcemap.
        .pipe( sourcemaps.init( { loadMaps: true } ) )
        // Uglify.
        .pipe( uglify() )
        // Render the JavaScript file in the directory with external sourcemaps.
        .pipe( gulp.dest( dest, { sourcemaps: '.' } ) )
        // Add BrowserSync stream.
        .pipe( browserSync.stream() );
};

/**
 * Compiles JavaScript.
 */
const loadJavaScript = async () => {
    paths.scripts.src.files.map( entryScript => mapScripts( entryScript, paths.scripts.src.main, paths.scripts.dest ) );
    paths.scripts.admin.files.map( entryScript => mapScripts( entryScript, paths.scripts.admin.src, paths.scripts.admin.dest ) );
};

/**
 * Watches for specified tasks.
 */
const doWatch = () => {
    // Watch for style updates.
    gulp.watch( paths.styles.watch, loadStyles );
    // Watch for script updates.
    gulp.watch( paths.scripts.watch, loadJavaScript );
    // Watch for PHP updates.
    gulp.watch( paths.php.watch, reload );
};

/**
 * Browser Sync.
 */
const doBrowserSync = () => {
    browserSync.init( {
        open: false,
        injectChanges: true,
        proxy: paths.projectURL,
        watch: true
    } );
};

/**
 * Tasks.
 */
// For Browser Sync. "gulp browser-sync" in CLI.
gulp.task( tasksList.browserSync, doBrowserSync );

// To compile stylesheet. "gulp style" in CLI.
gulp.task( tasksList.style, loadStyles );

// To compile script. "gulp js" in CLI.
gulp.task( tasksList.js, loadJavaScript );

// To watch for file changes. "gulp watch" in CLI.
gulp.task( tasksList.watch, doWatch );

// Task to run default tasks. "gulp" in CLI.
gulp.task( tasksList.default, gulp.parallel( tasksDefault ) );