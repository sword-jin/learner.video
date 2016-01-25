var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.sass('app.scss')
       .sass('lib.scss')
       .browserify('lib.js', 'public/js/lib.js')
       .browserify('admin/main.js', 'public/js/admin/admin.js')
       .copy('node_modules/font-awesome/fonts', 'public/build/fonts');

    mix.styles([
        'lib/ionicons.min.css',
        'lib/style.css'
    ], 'public/css/admin/admin.css', 'public/css');

    mix.version([
        'css/lib.css',
        'css/app.css',
        'js/lib.js',

        'js/admin/admin.js'
    ]);
});
