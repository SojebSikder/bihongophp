const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');

module.exports.Config = {

    js: (resources, public) => {

    },

    /**
     * Execute webpack
     */
    execute: (data) => {
        var resources = data.resources;
        var public = data.public;
        var bundle = data.bundle;
        if (bundle == null) {
            bundle = "bundle.js";

        }
        // const path = require('path');
        // const HtmlWebpackPlugin = require('html-webpack-plugin');

        return module.exports = {
            entry: resources,
            mode: process.env.NODE_ENV || "development",
            resolve: {
                modules: [path.resolve(__dirname, "resources/js"), "node_modules"]
            },
            output: {
                path: path.resolve(__dirname, public),
                publicPath: '/',
                filename: bundle
            },
            devServer: {
                contentBase: public,
            },
            module: {
                rules: [
                    {
                        test: /\.(js|jsx)$/,
                        exclude: /node_modules/,
                    },
                    {
                        test: /\.(js|jsx)$/,
                        exclude: /node_modules/,
                        use: ["babel-loader"]
                    },
                    {
                        test: /\.(css|scss)$/,
                        use: ["style-loader", "css-loader"],
                    },
                    {
                        test: /\.(jpg|jpeg|png|gif|mp3|svg)$/,
                        use: ["file-loader"]
                    },
                ]
            },
            plugins: [
                new HtmlWebpackPlugin({
                    template: path.resolve('./index.html'),
                }),
            ]
        };
    }
}



