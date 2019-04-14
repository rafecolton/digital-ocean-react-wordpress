module.exports = function(grunt) {

  grunt.file.setBase(__dirname);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    shell: {
      build: {
        command: 'GENERATE_SOURCEMAP=false NODE_PATH=$NODE_PATH:src yarn build --offline --production'
      },
    }
  });

  grunt.loadNpmTasks('grunt-shell');

  grunt.registerTask('build', ['shell:build']);
  grunt.registerTask('default', 'build');
};
