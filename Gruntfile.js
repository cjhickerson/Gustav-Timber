module.exports = function(grunt) {

  grunt.initConfig({
	cssmin: {
	  options: {
		shorthandCompacting: false,
		roundingPrecision: -1
	  },
	  target: {
		files: {
		  'css/theme.min.css': ['css/build/fonts.css', 'css/build/bootstrap.min.css', 'css/build/font-awesome.min.css', 'css/build/style.css']
		}
	  }
	},
	compress: {
	  main: {
		options: {
		  mode: 'gzip'
		},
		expand: true,
		cwd: 'css/',
		src: ['css/theme.min.css'],
		dest: 'css/theme.min.css'
	  }
	},
	watch: {
		files: ['css/build/*.css'],
		tasks: ['cssmin', 'compress']
	}
  });

  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-compress');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.registerTask('default', ['cssmin', 'compress']);

};
