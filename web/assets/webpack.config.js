const path = require('path');
const webpack = require('webpack');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
module.exports = {
    context: path.resolve(__dirname, './js'),
    entry: {
        main: './main.js',
    },
    output: {
        path: path.resolve(__dirname, './dist'),
        filename: '[name].bundle.js',
    },
    module: {
        rules: [{
            test: /\.sass$/, 
            loader: ExtractTextPlugin.extract({
              fallbackLoader: "style-loader",
              loader: "style-loader!css-loader!sass-loader?indentedSyntax=sass"
            }),
        }]
    },
  plugins: [
    new ExtractTextPlugin("styles.css"),
  ]
};

// Tuto: https://blog.madewithenvy.com/getting-started-with-webpack-2-ed2b86c68783
// Doc: https://webpack.js.org

// Note: __dirname refers to the directory where this webpack.config.js lives, which in this blogpost is the project root.
// Note: in the output, [name] stands for the entry name of your entry, in this case it's main