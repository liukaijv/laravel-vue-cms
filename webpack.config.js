var path = require('path');
var distPath = path.join(__dirname, 'public/admin');
var srcPath = path.join(__dirname, 'resources/admin');

var webpack = require('webpack');
var HtmlWebpackPlugin = require('html-webpack-plugin');
var ExtractTextPlugin = require("extract-text-webpack-plugin");

module.exports = {
    entry: {
        main: path.join(srcPath, 'bootstrap.js'),
        vendor: ['jquery']
    },
    output: {
        path: distPath,
        publicPath: '/admin/',
        filename: "js/[name]-[hash].js"
    },
    resolve: {
        extensions: ['', '.js', '.vue'],
        fallback: [path.join(__dirname, '../node_modules')]
    },
    resolveLoader: {
        root: path.join(__dirname, 'node_modules'),
    },
    module: {
        loaders: [{
            test: /\.js$/,
            loader: 'babel',
            include: path.resolve(__dirname, 'resources/admin'),
            exclude: /node_modules/,
            query: {
                presets: ['es2015']
            }
        }, {
            test: /\.vue$/,
            loader: 'vue'
        }, {
            test: /\.css$/,
            loader: ExtractTextPlugin.extract("style-loader", "css-loader")
        }, {
            test: /\.(png|jpg|gif|svg|woff2?|eot|ttf)(\?.*)?$/,
            loader: 'url',
            query: {
                limit: 10000,
                name: 'fonts/[name].[ext]'
            }
        }]
    },
    plugins: [
        new ExtractTextPlugin('css/[name].css'),
        new webpack.optimize.CommonsChunkPlugin('vendor', 'js/vendor-[hash].js'),
        new HtmlWebpackPlugin({
            template: path.join(srcPath, 'template/index.html')
        }),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            "window.jQuery": "jquery",
            "window.$": "jquery",
        })
    ],
    devServer: {
        hot: true,
        noInfo: false,
        proxy: {
            "/backend/*": {                
                target: "http://localhost:8000",
                changeOrigin: true         
            }
        }
    }
};
