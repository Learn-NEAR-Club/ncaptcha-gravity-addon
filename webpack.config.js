const TerserJSPlugin = require('terser-webpack-plugin');
const path = require('path');
module.exports = {
    optimization: {
        minimizer: [new TerserJSPlugin({})],
    },
    entry: ['./app.js'],
    output: {
        path: path.resolve(__dirname, 'public'),
        filename: './index.js',
    },
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                        plugins: ['@babel/plugin-transform-runtime']
                    }
                }
            }
        ]
    },
}