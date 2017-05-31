/*==============================================================================
Gulp
==============================================================================*/

var gulp = require( 'gulp' ),
	gulpLoadPlugins = require( 'gulp-load-plugins' ),
	p = gulpLoadPlugins();

function handleError( err ) {
	console.log( err.toString() );
	this.emit( 'end' );
}

/*==============================================================================
Clean
==============================================================================*/

gulp.task( 'clean', function() {
	gulp.src( [ 'css', 'js', 'images', 'fonts' ], { 
			read: false
		})
		.pipe( p.rimraf() )
		.pipe( p.notify( 'Gulp Clean Task Complete' ) );
});

/*==============================================================================
Styles
==============================================================================*/

gulp.task( 'styles', function() {
	return p.rubySass( 'src/scss/main.scss', {
			//container: 'gulp-ruby-sass-imports',
			style: 'expanded'
		})
		.on( 'error', handleError)
		.pipe( p.rename( 'main.css' ) )
		.pipe( gulp.dest( 'SoDown/css' ) )
		.pipe( p.autoprefixer() )
		.pipe( p.groupCssMediaQueries() )
		.pipe( p.minifyCss( { advanced: false } ) )
		.pipe( p.rename( 'main.min.css' ) )
		.pipe( gulp.dest( 'SoDown/css' ) )
		.pipe( p.notify( 'Gulp Styles Task Completed' ) );
});

/*==============================================================================
Fonts
==============================================================================*/

gulp.task( 'fonts', function() {
	gulp.src('src/fonts/**/*' )
		.pipe( gulp.dest( 'SoDown/fonts' ) )
		//.pipe( p.notify( 'Gulp Fonts Task Completed' ) );
});

/*==============================================================================
Scripts
==============================================================================*/

gulp.task( 'scripts1', function() {
	return gulp.src( [ 'src/js/*.js', '!src/js/imports.js',] )
		.pipe( p.jshint() )
		.pipe( p.jshint.reporter( 'default') );
});

gulp.task( 'scripts2', [ 'scripts1' ], function() {
	return gulp.src( 'src/js/lib/imports.js' )
		.pipe( p.imports() )
		.pipe( p.uglify() )
		.pipe( p.rename( 'imports.lib.min.js' ) )
		.pipe( gulp.dest( 'temp' ) );
});

gulp.task( 'scripts3', [ 'scripts2' ], function() {
	return gulp.src( 'src/js/imports.js' )
		.pipe( p.imports() )
		.pipe( p.uglify() )
		.on( 'error', handleError )
		.pipe( p.rename( 'imports.min.js' ) )
		.pipe( gulp.dest( 'temp' ) );
});

gulp.task( 'scripts4', [ 'scripts3' ], function() {
	return gulp.src( [ 'temp/imports.lib.min.js', 'temp/imports.min.js' ] )
		.pipe( p.concat( 'app.min.js') )
		.pipe( gulp.dest( 'SoDown/js' ) );
});

gulp.task( 'scripts5', [ 'scripts4' ], function() {
	return gulp.src( 'temp', {
			read: false
		})
		.pipe( p.rimraf() );
});

gulp.task( 'scripts', [ 'scripts5' ], function() {
	return gulp.src( 'src/js/lib/modernizr.min.js' )
		.pipe( gulp.dest( 'SoDown/js' ) )
		.pipe( p.notify( 'Gulp Scripts Task Complete' ) );
});

/*==============================================================================
Images
==============================================================================*/

gulp.task( 'images', function() {
	gulp.src( 'src/img/**/*' )
		.pipe( p.changed( 'SoDown/img' ) )
		.pipe( p.imagemin( { optimizationLevel: 3, progressive: true, interlaced: true } ) )
		.pipe( gulp.dest( 'SoDown/img' ) )
		.pipe( p.notify( 'Gulp Images Task Completed' ) );
});


/*==============================================================================
Watch
==============================================================================*/

gulp.task('watch', function() {
	gulp.watch( 'src/scss/**/*', [ 'styles' ] );
	gulp.watch( 'src/js/**/*.js', [ 'scripts' ] );
	gulp.watch( 'src/img/**/*', [ 'images' ] );
});

/*==============================================================================
Default
==============================================================================*/

gulp.task( 'default', [ 'styles', 'scripts', 'images' ], function() {
	gulp.start( 'watch' );
});