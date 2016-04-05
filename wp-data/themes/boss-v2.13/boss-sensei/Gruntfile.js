'use strict';
module.exports = function ( grunt ) {

    // load all grunt tasks matching the `grunt-*` pattern
    // Ref. https://npmjs.org/package/load-grunt-tasks
    require( 'load-grunt-tasks' )( grunt );

    grunt.initConfig( {
        // Watch for hanges and trigger compass and uglify
        // Ref. https://npmjs.org/package/grunt-contrib-watch
        cssmin: {
            target: {
                files: {
                    'assets/css/sensei-rtl.min.css': 'assets/css/sensei-rtl.css',
                    'assets/css/sensei.min.css': 'assets/css/sensei.css'
                }
            }
        },
        // autoprefixer
        autoprefixer: {
            options: {
                browsers: [ 'last 2 versions', 'ie 9', 'ios 6', 'android 4' ],
                map: true
            },
            files: {
                expand: true,
                flatten: true,
                src: 'assets/css/*.css',
                dest: 'assets/css'
            }
        },
        // Uglify
        // Compress and Minify JS files in 'js/compressed/boss-main-min.js'
        // Ref. https://npmjs.org/package/grunt-contrib-uglify
        uglify: {
            options: {
                banner: '/*! \n * Boss Theme JavaScript Library \n * @package Boss Theme \n */'
            },
            frontend: {
                src: [
                    'assets/js/sensei.js'
                ],
                dest: 'assets/js/sensei.min.js'
            }
        }
    } );

    // register task
    //grunt.registerTask( 'default', [ 'sass', 'autoprefixer', 'uglify', 'checktextdomain', 'makepot', 'watch' ] );
    grunt.registerTask( 'default', [ 'cssmin', 'uglify' ] );
};