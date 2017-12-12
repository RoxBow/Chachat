module.exports = function (grunt) {

  let frontPath = 'front/';

  grunt.initConfig({
    watch: {
      css: {
        files: [frontPath+'sass/*.scss'],
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
          cwd: frontPath+'sass/',
          src: ['*.scss'],
          dest: frontPath+'./css/',
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