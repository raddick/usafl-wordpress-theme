module.exports = function(grunt) {

   const sass = require('node-sass');
   require('load-grunt-tasks')(grunt);
 
   grunt.initConfig({
       sass: {
           options: {
               implementation: sass,
               sourceMap: true
           },
           dist: {
               files: {
                   'style.css': 'assets/scss/main.scss'
               }
           }
       },
      'string-replace': {
          dist: {
	      files: {
		  'style.css': 'style.css'
	      },
	      options: {
		  replacements: [{
		  	 pattern: '@charset "UTF-8";\n',
			 replacement: ''
 		     }]
	      }
	  }
      },
      pkg: grunt.file.readJSON('package.json'),
      uglify: {
	   options: {
              banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
           },
	  build: {
	      src: 'style.css', 
              dest: 'style-min.css'
	   }
	}
   });

   grunt.loadNpmTasks('grunt-string-replace');


   grunt.registerTask('default', ['dev']);

   grunt.registerTask('dev', [
	'sass',
	'string-replace'
   ]);

   grunt.registerTask('build', [
	'sass',
	'uglify'
   ]);
} 
