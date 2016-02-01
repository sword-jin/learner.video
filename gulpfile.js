var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.sass('app.scss')
       .sass('lib.scss')
       .copy('node_modules/font-awesome/fonts', 'public/build/fonts');

    mix.copy('resources/assets/css/prism-cop.css', 'public/build/css/prism-cop.css');

    mix.styles([
        'lib/ionicons.min.css',
        'lib/style.css'
    ], 'public/css/admin/admin.css', 'public/css');

    mix.version([
        'css/lib.css',
        'css/app.css'
    ]);
});
