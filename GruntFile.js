/*!
 * http://blog.thomaspuppe.de
 * @author Thomas Puppe
 */

'use strict';

module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),


        shell: {
            compileOutputHtml: {
                command: 'acrylamid compile'
            }
        },

        sass: {
            dist: {
                files: {
                    './themes/svbtle/style.css': './themes/svbtle_scss/styles.scss'
                },
                options: {
                    style: 'nested' // expanded, nested, compact, compressed
                }
            }
        },
        browserSync: {
            default_options: {
                bsFiles: {
                    src: [
                        './output/*'
                    ]
                },
                options: {
                    watchtask: true,
                    server: {
                        baseDir: './output/'
                    }
                }
            }


/*
            bsFiles: {
                src: 'themes/** /*.scss'
            },
            options: {
                watchTask: true

                server: {
                    baseDir: './output/'
                },
                options: {
                    watchTask: true
                }

            }
                            */
        },
        watch: {
            css: {
                files: './themes/svbtle_scss/**/*.scss',
                tasks: ['sass']
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.loadNpmTasks('grunt-shell');
    grunt.registerTask('default',
        ['shell', 'sass', 'browserSync', 'watch']
    );
};
