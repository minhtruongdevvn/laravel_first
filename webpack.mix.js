const mix = require('laravel-mix');

mix.browserSync({
    proxy: 'http://127.0.0.1:8000', // Replace with your local development URL
    open: true, // Opens the browser when the command is run
    notify: true, // Controls the notifications in the corner of the browser
});

const postCssPlugins = [
    require('postcss-import'),
    require('tailwindcss'),
];

mix.js('resources/js/app.js', 'public/js')
    .ts('resources/ts/app.ts', 'public/js')
    .vue()
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
