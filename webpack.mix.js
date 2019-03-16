const mix = require('laravel-mix');

mix.setPublicPath('public');

mix.webpackConfig((webpack) => {
    return {
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'window.jQuery': 'jquery',
                'Popper': 'popper.js',
            })
        ]
    };
});

mix.js('resources/js/main.js', 'public/js')
    .js('resources/js/pages/tasks.js', 'public/js')
    .sass('resources/sass/main.scss', 'public/css');
