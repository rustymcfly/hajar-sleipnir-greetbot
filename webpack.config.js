const TerserPlugin = require('terser-webpack-plugin')
const {ProvidePlugin} = require('webpack')

module.exports = {
    plugins: [
        new ProvidePlugin({
            process: 'process/browser'
        })
    ],
    optimization: {
        minimizer: [
            new TerserPlugin({
                extractComments: false
            })
        ]
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
                    'style-loader',
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: process.env.NODE_ENV !== 'production'
                        }
                    }
                ]
            },
            {
                test: /\.scss$/,
                use: [
                    'style-loader',
                    'css-loader',
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: process.env.NODE_ENV !== 'production'
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
                            modules: false,
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
                test: /\.(graphql|gql)$/,
                exclude: /node_modules/,
                loader: 'graphql-tag/loader'
            },
            {
                test: /\.(svg|md)$/i,
                type: 'asset/source'
            },
            {
                resourceQuery: /source/,
                type: 'asset/source'
            },
            {
                test: /\.(png|jpe?g|gif|eot|woff|ttf|woff[2]*|otf|mp3|wav)$/i,
                type: 'asset/inline'
            }
        ]
    },
    resolve: {
        extensions: ['.js', '.vue'],
        modules: ['src', 'node_modules']
    }
};
