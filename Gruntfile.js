module.exports = function (grunt) {

  let path = 'back/';

  grunt.initConfig({
    watch: {
      css: {
        files: [path+'dists/sass/*.scss'],
        tasks: ['sass:dist']
      },
    },
    sass: {
      dist: {
        options: {
          style: 'compressed', // css minify
          sourcemap: 'none'
        },
        files: [{
          expand: true,
          cwd: path+'dists/sass/',
          src: ['*.scss'],
          dest: path+'dists/css/',
          ext: '.css'
      }]
      }
    },
  });

  grunt.loadNpmTasks('grunt-contrib-sass'); // compass
  grunt.loadNpmTasks('grunt-contrib-watch'); // watcher

  // Default task(s).
  grunt.registerTask('default', ['sass:dist','watch']);

};