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
          'js/dist/app.js': ['<%= concat.app.dest %>']
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
      },
      app: {
        src: ['js/dev/**/*.js'],
        dest: 'js/tmp/app.concat.js',
        nonull: true
      }
    },
    watch: {
      options: {
        livereload: true
      },
      twig: {
        files: ['core/modules/**/*.twig'],
        tasks: []
      },
      js: {
        files: ['js/dev/**/**/*.js', 'js/dev/**/*.js', 'js/**/*.hbs'],
        tasks: ['devjs']
      },
      sprites: {
        files: ['images/_sprites/*'],
        tasks: ['exec:sprites']
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
      },
      hbs: {
        files: ['js/**/*.hbs'],
        tasks: []
      }
    },
    clean: ["js/tmp"],
    autoprefixer: {
      // prefix the specified file
      single_file: {
        src: 'app.css',
        dest: 'app.css'
      }
    },
    sass: {
      options: {                       // Target options
        outputStyle: 'compressed',
        includePaths: ['bower_components/foundation/scss'],
        sourceMap: false,
        sourceComments: false
      },
      dist: {                            // Target
        files: {                         // Dictionary of files
          'app.css': 'scss/app.scss',
          'login.css': 'scss/login.scss'
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

  // Default task(s).
  grunt.registerTask('default', ['concat', 'uglify', 'compass:dev', 'autoprefixer', 'clean', 'jshint']);
  grunt.registerTask('cssdev', ['sass', 'autoprefixer']);
  grunt.registerTask('devjs', ['concat', 'uglify', 'clean']);
};