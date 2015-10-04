module.exports = function (grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      dist: {
        options: {
          banner: '/*! <%= pkg.name %> ProdVersion <%= grunt.template.today("yyyy-mm-dd hh:mm") %> */\n',
          mangle: true,
          beautify: false,
          compress: true,
          drop_console: true
        },
        files: {
          'js/dist/plugins.js': ['<%= concat.plugins.dest %>'],
          //'js/dist/app.js': ['js/dev/app.js'],
        }
      },
      dev: {
        options: {
          banner: '/*! <%= pkg.name %> DevVersion <%= grunt.template.today("yyyy-mm-dd") %> */\n',
          mangle: false,
          beautify: true,
          compress: false,
          drop_console: false
        },
        files: {}
      }
    },
    concat: {
      options: {
        seperator: ';'
      },
      plugins: {
        src: ['js/dev/plugins/**/*.js'],
        dest: 'js/tmp/plugins.concat.js',
        nonull: true
      }
    },
    watch: {
      options: {
        livereload: true
      },
      js: {
        files: ['js/dev/**/**/*.js', 'js/dev/**/*.js'],
        tasks: ['devjs']
      },
      sass: {
        options: {
          livereload: false
        },
        files: ['scss/**/*.scss'],
        tasks: ['cssdev']
      },
      css: {
        files: ['*.css'],
        tasks: []
      }
    },
    clean: ["js/tmp"],
    browserify: {
      options: {
        browserifyOptions: {
          paths: ["./js"],
          fast: true,
          detectGlobals: false
        }
      },
      app: {
        src: 'js/dev/app.js',
        dest: 'js/dist/app.js'
      }
    },
    autoprefixer: {
      // prefix the specified file
      single_file: {
        src: 'remindr.css',
        dest: 'remindr.css'
      }
    },
    sass: {
      options: {                       // Target options
        outputStyle: 'compressed',
        sourceMap: false,
        sourceComments: true
      },
      dist: {                            // Target
        files: {                         // Dictionary of files
          'remindr.css': 'scss/remindr.scss'
        }
      }
    }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-notify');
  grunt.loadNpmTasks('grunt-browserify');

  // Default task(s).
  grunt.registerTask('default', ['concat', 'uglify', 'autoprefixer', 'clean', 'jshint']);
  grunt.registerTask('cssdev', ['sass', 'autoprefixer']);
  grunt.registerTask('devjs', ['browserify', 'concat', 'uglify', 'clean']);
  //grunt.registerTask('devjs', ['browserify','concat', 'uglify', 'clean']);
};