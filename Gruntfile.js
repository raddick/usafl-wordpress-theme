const sass = require('node-sass');
module.exports = function(grunt) {

  grunt.initConfig({
    sass: {
      dist: {
        options: {
          implementation: sass
        },
        files: {
          'style.css': 'assets/scss/main.scss'
        }
      }
    }
  });
  grunt.loadNpmTasks('grunt-sass');
  grunt.registerTask('default', ['sass']);
};