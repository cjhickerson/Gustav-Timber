module.exports = function(grunt) {

  grunt.initConfig({
	cssmin: {
	  options: {
		shorthandCompacting: false,
		roundingPrecision: -1
	  },
	  target: {
		files: {
		  'css/theme.min.css': ['build/fonts.css', 'build/bootstrap/dist/css/bootstrap.css', 'build/font-awesome.min.css', 'build/style.css']
		}
	  }
	},
	uglify: {
		options: {
			mangle: false
		},
		my_target: {
			files: {
				'js/theme.min.js': ['build/theme.js','build/bootstrap/dist/js/bootstrap.js']
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
		files: ['build/*.css', 'build/*.js'],
		tasks: ['cssmin', 'uglify', 'compress']
	}
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-compress');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.registerTask('default', ['cssmin', 'compress', 'uglify']);

};
