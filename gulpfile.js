var gulp = require("gulp"),
    sass = require("gulp-sass"),
    postcss = require("gulp-postcss"),
    autoprefixer = require("autoprefixer"),
    cssnano = require("cssnano"),
    sourcemaps = require("gulp-sourcemaps");

var browserSync = require("browser-sync").create();

// Put this after including our dependencies
var paths = {
    styles: {
        // By using styles/**/*.sass we're telling gulp to check all folders for any sass file
        src: "./*.scss",
        // Compiled files will end up in whichever folder it's found in (partials are not compiled)
        dest: "."
    },
    js: {
        src: "./*js"
    }
};


// Define tasks after requiring dependencies
function style() {
    // Where should gulp look for the sass files?
    // My .sass files are stored in the styles folder
    // (If you want to use scss files, simply look for *.scss files instead)
    return (
        gulp
            .src(paths.styles.src)

            // Initialize sourcemaps before compilation starts
            .pipe(sourcemaps.init())
            .pipe(sass())
            .on("error", sass.logError)
            // Use postcss with autoprefixer and compress the compiled file using cssnano
            .pipe(postcss([autoprefixer(), cssnano()]))
            // Now add/write the sourcemaps
            .pipe(sourcemaps.write())
            // What is the destination for the compiled file?
            .pipe(gulp.dest(paths.styles.dest))
            // Add browsersync stream pipe after compilation
            .pipe(browserSync.stream())
    );
}

// Expose the task by exporting it
// This allows you to run it from the commandline using
// $ gulp style
exports.style = style;

// A simple task to reload the page
function reload() {
    browserSync.reload();
}


function watch(){

    browserSync.init([paths.styles.src, paths.js.src],{
        // You can tell browserSync to use this directory and serve it as a mini-server
        // server: {
        //     baseDir: "./"
        // }

        // If you are already serving your website locally using something like apache
        // You can use the proxy setting to proxy that instead
        proxy: "http://round-photo-library/",
        notify: true
    });

    style();
    // gulp.watch takes in the location of the files to watch for changes
    // and the name of the function we want to run on change
    gulp.watch(paths.styles.src, style)

    // We should tell gulp which files to watch to trigger the reload
    // This can be html or whatever you're using to develop your website
    // Note -- you can obviously add the path to the Paths object
    gulp.watch(paths.styles.src, reload);
}

// Don't forget to expose the task!
exports.watch = watch