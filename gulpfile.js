var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

elixir(function(mix) {
    mix.sass('app.scss')
       .browserify('main.js', 'public/js/app.js')
       .copy('node_modules/font-awesome/fonts', 'public/fonts');
});
