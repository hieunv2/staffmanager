const mix = require('laravel-mix')
const path = require('path')
const webpack = require('webpack')
require('laravel-mix-svg-sprite')

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
mix.options({
  vue: {
    preserveWhitespace: false
  },
  hmrOptions: {
    host: 'localhost',
    port: '8081'
  },
  uglify: {
    compress: false
  }
})
mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      'vue$': 'vue/dist/vue.esm.js',
      '@': path.resolve(__dirname, 'resources/assets')
    }
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.config': require(path.resolve(__dirname, 'resources/assets/common/config/dev.env.js'))
    })
  ]
})

mix
  .js('resources/assets/backend/main.js', 'public/backend')
  .js('resources/assets/frontend/main.js', 'public/frontend')
  .svgSprite('resources/assets/common/icons/svg', 'public', { symbolId: 'icon-[name]' })
