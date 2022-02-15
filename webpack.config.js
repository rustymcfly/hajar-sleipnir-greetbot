const {DefinePlugin} = require('webpack');
const path = require('path');
const fs = require('fs');
const ip = require('ip');
const {VueLoaderPlugin} = require('vue-loader');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MildCompilePlugin = require('webpack-mild-compile').Plugin;
module.exports = {
    mode: 'development',
    entry:[ path.resolve('src/page/index.js'),  path.resolve('src/page/assets/style.scss')],
    output: {
        publicPath: '',
        path: path.resolve('dist'),
        filename: 'assets/js/index.js',
        assetModuleFilename: (path) => {
            return path.filename.replace('src/', '');
        }
    },
    plugins: [
        new VueLoaderPlugin(),
        new MiniCssExtractPlugin(),
        new HtmlWebpackPlugin({
            inject: true,
            template: './src/page/index.html',
            filename: 'index.html'
        }),
        new DefinePlugin({
            DEV_SERVER_IP: JSON.stringify(ip.address())
        }),
        new MildCompilePlugin()
    ],
    optimization: {
        minimize: false
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /^(?=.*\.css)(?!.*ignore).*$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: true
                        }
                    }
                ]
            },
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {loader: 'css-loader'},
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true
                        }
                    }

                ]
            },
            {
                test: /\.js$/,
                loader: 'babel-loader',
                options: {
                    presets: [
                        ['@babel/preset-env', {
                            modules: 'amd',
                            useBuiltIns: 'entry',
                            corejs: 3
                        }]
                    ],
                    plugins: [
                        '@babel/plugin-transform-runtime',
                        "@babel/plugin-transform-modules-commonjs",
                        '@babel/plugin-proposal-export-default-from',
                        '@babel/plugin-proposal-class-properties'
                    ]
                }
            },
            {
                test: /\.(svg|md)$/i,
                type: 'asset/source'
            },
            {
                test: /\.(png|jpe?g|gif|eot|woff|ttf|woff[2]*|otf|mp3|wav)$/i,
                type: 'asset'
            },
            {
                test: /\.(ts)$/i,
                loader: 'ts-loader'
            },
            {
                test: /\.(graphql|gql)$/,
                exclude: /node_modules/,
                type: 'asset/source'
            }
        ]
    },
    resolve: {
        alias: {
            '@': path.resolve('./src')
        },
        modules: ['src', 'node_modules'],
        extensions: ['.js', '.vue']
    },
    stats: {
        warnings: false,
        children: false
    }
};
