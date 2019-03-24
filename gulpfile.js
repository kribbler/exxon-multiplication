var elixir = require('laravel-elixir');

elixir.config.assetsPath = 'webroot'; //This will contain all our source files
elixir.config.publicPath = 'webroot'; // compiled files goes here
var bowerComponentsPath = "./bower_components";

elixir(function(mix) {
    mix.styles([
        'base.css',
        'cake.css',
        'home.css',
        bowerComponentsPath + '/bootstrap/dist/css/bootstrap.min.css'
    ]);

    mix.scripts([
        'default.js',
    ]);
});