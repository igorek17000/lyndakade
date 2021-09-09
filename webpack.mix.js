const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .scripts(["public/js/my-js.js", "public/js/search.js"], "public/js/all.js")
    .copyDirectory("node_modules/jquery/dist", "public/jquery")
    .copyDirectory(
        "node_modules/jquery-typeahead/dist",
        "public/jquery-typeahead"
    )
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/toastr.scss", "public/css")
    .styles(
        [
            "public/css/bootstrap/bootstrap.min.css",
            "public/css/fonts.css",
            "public/css/icons.css",
            "public/css/googlefont.css",
            "public/css/font-awesome/all.css",
            "public/css/owl.carousel.css",
            "public/css/owl.transitions.css",
            "public/css/themify-icons.css",
            "public/css/toastr.min.css",
            "public/css/lyndacon.css",
            "public/css/my-stylesheet.css"
        ],
        "public/css/all.css"
    )
    .webpackConfig({
        module: {
            noParse: [/node_modules[\\/]videos\.js/]
        }
    });
