var gulp = require( 'gulp' ),
    plumber = require( 'gulp-plumber' ),
    watch = require( 'gulp-watch' ),
    livereload = require( 'gulp-livereload' ),
    minifycss = require( 'gulp-minify-css' ),
    //jshint = require( 'gulp-jshint' ),
    //stylish = require( 'jshint-stylish' ),
    uglify = require( 'gulp-uglify' ),
    rename = require( 'gulp-rename' ),
    notify = require( 'gulp-notify' ),
    include = require( 'gulp-include' ),
    clean = require('gulp-clean'),
    sass = require( 'gulp-sass' );

var onError = function( err ) {
    console.log( 'An error occurred:', err.message );
    this.emit( 'end' );
};

var sassPath = './sass/style.scss';

gulp.task( 'scss', function() {
    return gulp.src( sassPath )
        .pipe( plumber( { errorHandler: onError } ) )
        .pipe( sass() )
        .pipe( gulp.dest( '.' ) )
        .pipe( minifycss() )
        .pipe( rename( { suffix: '.min' } ) )
        .pipe( gulp.dest( '.' ) )
        .pipe( livereload() );
} );

gulp.task('clean', function () {
    return gulp.src('build', {read: false})
        .pipe(clean());
});

gulp.task( 'build', ['clean', 'scss'], function() {
    gulp.src('style.css')
        //.pipe( rename( 'style.css' ) )
        .pipe(gulp.dest('build'));
    gulp.src('*.php')
        .pipe(gulp.dest('build'));
    gulp.src('*.png')
        .pipe(gulp.dest('build'));
    gulp.src('.jscsrc')
        .pipe(gulp.dest('build'));
    gulp.src('template-parts/*')
        .pipe(gulp.dest('build/template-parts'));
    gulp.src('layouts/*')
        .pipe(gulp.dest('build/layouts'));
    gulp.src('languages/*')
        .pipe(gulp.dest('build/languages'));
    gulp.src('js/*')
        .pipe(gulp.dest('build/js'));
    gulp.src('include/widgets/*')
        .pipe(gulp.dest('build/include/widgets'));
    gulp.src('inc/*')
        .pipe(gulp.dest('build/inc'));
    gulp.src('fonts/**/*')
        .pipe(gulp.dest('build/fonts'));
});

gulp.task( 'watch', function() {
    livereload.listen();
    gulp.watch( './sass/**/*.scss', [ 'scss' ] );
    gulp.watch( './**/*.php' ).on( 'change', function( file ) {
        livereload.changed( file );
    } );
} );

gulp.task('default', ['watch'], function() {

});