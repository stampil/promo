/* 
 * usage : start grunt watch --compile=true : lance le watch et compress les fichier comme si il y avait eu un changement
 * start grunt watch lance le watch normalement ( start : lance dans une nouvelle console )
 */
module.exports = function (grunt) {

    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks("grunt-jsbeautifier");
    grunt.loadNpmTasks('grunt-contrib-watch');

    var opt_launch = grunt.option('compile') || false;
    
    var local = grunt.file.readJSON('package_local.json');
    local.num_built++;
    grunt.file.write('package_local.json',JSON.stringify(local));
    

    var jsSrc= ['wp-content/themes/chorum/dev/js/*.js'];
    var jsDist = 'wp-content/themes/chorum/prod/js/';
    var date = new Date();
    
    var last_update='no-cache_'+date.getTime()+Math.round(Math.random()*1000+1000)+local.num_built+'_';
    
    console.log('Grunt ready (⌐■_■)');
    console.log('start grunt watch --compile pour lancer le watch dans une autre console et lancer une compilation');
    console.log('env:', local.env, ' author:'+local.author, ' num_built:'+local.num_built+' uniqid:'+last_update);
    grunt.initConfig({
        clean: {
            first:[jsDist]+'*',
            last:[jsDist]
        }, //supprime tout les fichiers precedement construit de js
        uglify: { // probleme pas de variable ( temps ) dans les .js de destination
            
            options: {
                compress: {
                    drop_console: (local.env=="dev"?false:true)
                }
            },
            dist: {
                files: [{
                    expand: true,
                    cwd: jsDist,
                    src: '**/*.js',
                    dest: jsDist
                }]
            },
            dev:{
                
            }

        },
        cssmin: {
            options: {
              shorthandCompacting: (local.env=="dev"?false:true),
              roundingPrecision: -1
            },
            dist: {
              files: {
                'wp-content/themes/chorum/prod/css/chorum.css': ['wp-content/themes/chorum/prod/css/chorum.css']
              }
            },
            dev:{
                
            }
        },
        copy: {
            main: {
                files: 
                [
                    {
                        expand: true, 
                        cwd: 'wp-content/themes/chorum/dev/js/', 
                        src: ['**/*'], 
                        dest: jsDist , 
                        rename: function(dest, src) {
                          // use the source directory to create the file
                          // example with your directory structure
                          //   dest = 'dev/js/'
                          //   src = 'module1/js/main.js'
                          return dest + last_update + src ;
                        }
                    }
                ]
            }
        },
        compass: {                  // Task
            dist: {                   // Target
              options: {              // Target options
                sassDir: 'wp-content/themes/chorum/dev/scss',
                cssDir: 'wp-content/themes/chorum/prod/css',
                environment: 'production',
                noLineComments:true,
                outputStyle:'compressed'
              }
            },
            dev: {                    // Another target
              options: {
                sassDir: 'wp-content/themes/chorum/dev/scss',
                cssDir: 'wp-content/themes/chorum/prod/css',
                noLineComments:true,
                outputStyle:'expanded'
              }
            }
        },
        jsbeautifier : {
            files : ["package_local.json"],
            options : {
            }
        },
        watch: {
            options:{
                atBegin:opt_launch
            },
            scripts:{
                files: ["wp-content/themes/chorum/dev/scss/*", "wp-content/themes/chorum/dev/js/*"],
                tasks: ["clean:first", "compass:" + local.env,  "copy", "cssmin:"+ local.env, "uglify:"+ local.env, "jsbeautifier"] //"scss:" + local.env,
            }
        }
    });
};

