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
          'js/dist/app.js': ['<%= concat.app.dest %>'],
          'bower_components/modernizr/modernizr.min.js': ['bower_components/modernizr/modernizr.js']
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
    compass: {
      dist: {
        options: {
          config: 'config.rb',
          basePath: ''
        }
      },
      dev: {
        options: {
          config: 'config-dev.rb',
          basePath: ''
        }
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
    jshint: {
      src: ['js/dist/**/*.js'],
      options: {
        force: false,
        unused: true,
        browser: true,
        globals: {
          jQuery: true,
          _: true,
          Backbone: true,
          console: true
        }
      }
    },
    autoprefixer: {
      // prefix the specified file
      single_file: {
        src: 'app.css',
        dest: 'app.css'
      }
    },
    exec: {
      sprites: {
        command: 'glue images/_sprites/ scss/partials --retina --padding=1 --force --scss-template=sprite-tpl.jinja --img=images --sprite-namespace= --namespace= --scss'
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
    },
    imagemin: {                          // Task
      dynamic: {                         // Another target
        files: [{
          expand: true,                  // Enable dynamic expansion
          cwd: 'raw-images/',                   // Src matches are relative to this path
          src: ['**/*.{png,jpg,gif}'],   // Actual patterns to match
          dest: 'images/'                  // Destination path prefix
        }]
      },
      static: {                         // Another target
        files: [{
          expand: true,                  // Enable dynamic expansion
          cwd: '../_sb_website/',                   // Src matches are relative to this path
          src: ['**/*.{png,jpg,gif}'],   // Actual patterns to match
          dest: '../_sb_website/optimized/'                  // Destination path prefix
        }]
      }
    }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-notify');
  grunt.loadNpmTasks('grunt-exec');

  // Default task(s).
  grunt.registerTask('default', ['concat', 'uglify', 'compass:dev', 'autoprefixer', 'clean', 'jshint']);
  grunt.registerTask('cssdev', ['sass', 'autoprefixer']);
  grunt.registerTask('devjs', ['concat', 'uglify', 'clean']);
};