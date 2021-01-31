const mix = require('laravel-mix');

const glob = require('glob');
const path = require('path');
//const Dotenv = require('dotenv-webpack');
//var envPlugin = new Dotenv();

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

mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/admin.js', 'public/js')
    .sass('resources/sass/front.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    ;

/**
 * Gather files from modules. stored in separete files.
 * it is recommended to have only entry files in <modulepath>/resources/[js|css]/<theme>/*.(js|css)
 * and others needed libs and styles include or import in js. scss works too and makes css. (see enableSassLoader above)
 */
var
    pathSearch = "modules/**/resources/@(js|css)/*",
    pattern = /modules\/(?<vendor>.*)\/resources\/(?<type>js|css)\/(?<name>.+)\..+$/g;

glob.sync(pathSearch).map(file => {
    let result = [...file.matchAll(pattern)][0];
    if (result) {
        result = result.groups;
        switch (result.type) {
            case 'js'  : mix.js(path.resolve(file),  'public/js/'  + `${result.vendor}`); break;
            case 'css' : mix.css(path.resolve(file), 'public/css/' + `${result.vendor}`); break;
        }
    }
});

