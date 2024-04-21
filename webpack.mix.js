const mix = require('laravel-mix');

const postCssPlugins = [
    require('postcss-import'),
    require('tailwindcss'),
];

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', postCssPlugins)
    .postCss('resources/css/note.css', 'public/css', postCssPlugins);

// If you're using React, you might use:
// mix.react('resources/js/app.js', 'public/js');

// If you're using SASS/SCSS:
// mix.sass('resources/sass/app.scss', 'public/css');

// Versioning and cache busting
if (mix.inProduction()) {
    mix.version();
}
