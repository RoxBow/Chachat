module.exports = function (grunt) {


    var path = './dists';
    grunt.initConfig({
        watch: {
            css: {
                files: [path +'/sass/*.scss'],
                tasks: ['sass:dist']
            },
            js: {
                files: [path +'/js/*.js'],
                tasks: ['babel:dist']
            }
        },
        sass: {
            dist: {
                options: {
                    style: 'compressed', // css minify
                    sourcemap: 'none'
                },
                files: [{
                    expand: true,
                    cwd: path+'/sass/',
                    src: ["*.scss", "**/*.scss"],
                    dest: path+'/css/',
                    ext: '.css'
                }]
            }
        },
        babel: {
            options: {
                "sourceMap": false
            },
            dist: {
                files: [{
                    "expand": true,
                    "cwd": path+"/js",
                    "src": ["*.js","**/*.js"],
                    "dest": path+"/js-compiled/",
                    "ext": ".js"
                }]
            }
        },
    });

    grunt.loadNpmTasks('grunt-contrib-sass'); // compass
    grunt.loadNpmTasks('grunt-contrib-watch'); // watcher
    grunt.loadNpmTasks('grunt-babel'); // babel

    // Default task(s).
    grunt.registerTask('default', ['sass:dist', 'babel', 'watch']);

};