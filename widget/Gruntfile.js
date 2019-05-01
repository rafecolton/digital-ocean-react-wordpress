module.exports = function(grunt) {

  grunt.file.setBase(__dirname);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    watch: {
      react: {
        files: [
          __dirname + 'package.json',
          __dirname + '/src/**/*.js',
          __dirname + '/public/index.html'
        ],
        tasks: ['shell:build']
      },
    },

    shell: {
      build: {
        command: 'GENERATE_SOURCEMAP=false NODE_PATH=$NODE_PATH:src yarn build --offline --production'
      },
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-shell');

  grunt.registerTask('build', ['shell:build']);
  grunt.registerTask('default', 'simple-watch');
};
