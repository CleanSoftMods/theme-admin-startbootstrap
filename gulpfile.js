var gulp = require('gulp');
var shell = require('gulp-shell');
var elixir = require('laravel-elixir');
var themeInfo = require('./theme.json');

// load the config class & boot the methods
config = require('../../resources/assets/js/elixir-config');
for (var method in config) {
    if (typeof config[method] == "function") {
        config[method](elixir, gulp, shell, themeInfo);
    }
}

elixir(function(mix) {
    mix.less('app.less');
    mix.scripts([
        'assets/vendor/jquery/dist/jquery.js',
        'assets/vendor/bootstrap/dist/js/bootstrap.js',
        '../../../resources/assets/js/init.js',
        'assets/vendor/jquery-ujs/src/rails.js',
        'assets/js/jquery.metisMenu.js',
        'assets/js/sb-admin.js'
    ], null, 'resources');
    mix.copy('resources/assets/vendor/font-awesome/fonts', 'assets/fonts');
    mix.copy('resources/assets/vendor/bootstrap/fonts', 'assets/fonts');
    mix.themePublish();
});
