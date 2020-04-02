var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    
    
    .copyFiles({
                 from: './assets/icons',
        
                //optional target path, relative to the output dir
                 to: 'images/[path][name]',
        
               })

    
    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('mystyle', './assets/css/style.css')
    .addEntry('login', './assets/css/login.css')
    

    .addEntry('reference', './assets/icons/reference.png')
    .addEntry('trace', './assets/icons/trace.png')
    .addEntry('calcul', './assets/icons/calcul.png')
    .addEntry('exercice', './assets/icons/exercice.png')
    .addEntry('home', './assets/icons/home.png')
    .addEntry('add', './assets/icons/add.png')
    .addEntry('vider', './assets/icons/vider.png')
    .addEntry('link', './assets/icons/link.png')
    .addEntry('user', './assets/icons/user.png')
    .addEntry('disconnect', './assets/icons/disconnect.png')


     
    //.addEntry('page2', './assets/js/page2.js')

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables Sass/SCSS support
    //.enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()

    // uncomment if you use API Platform Admin (composer req api-admin)
    //.enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')
;

module.exports = Encore.getWebpackConfig();
