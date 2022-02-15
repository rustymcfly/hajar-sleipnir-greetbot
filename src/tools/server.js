const http = require('http')
const fs = require('fs')
const path = require('path')
const state = require('./bot.js').getState
const url = require('url');
const Knowledgebase = require('./knowledgebase');

module.exports = {
    createServer: function (port, folder) {
        const knowledgebase = new Knowledgebase();
        http.createServer(function (request, response) {
            const URL = url.parse(request.url, true)
            if (URL.pathname === '/state') {
                response.writeHead(200, {'Content-Type': 'application/json'});
                response.writeHead(200, {'Access-Control-Allow-Origin': '*'});
                response.end(JSON.stringify({state: state()}), 'utf-8');
                return
            }
            if (URL.pathname === '/query') {
                const result = knowledgebase.query(URL.query);
                response.end(JSON.stringify(result), 'utf-8');
                return
            }
            let filePath = folder + request.url;
            if (filePath === folder + '/')
                filePath = folder + '/index.html';

            const extname = path.extname(filePath);
            let contentType = 'text/html';
            switch (extname) {
                case '.js':
                    contentType = 'text/javascript';
                    break;
                case '.css':
                    contentType = 'text/css';
                    break;
                case '.json':
                    contentType = 'application/json';
                    break;
                case '.png':
                    contentType = 'image/png';
                    break;
                case '.jpg':
                    contentType = 'image/jpg';
                    break;
                case '.wav':
                    contentType = 'audio/wav';
                    break;
            }

            fs.readFile(filePath, function (error, content) {
                if (error) {
                    if (error.code === 'ENOENT') {
                        fs.readFile(folder + '/404.html', function (error, content) {
                            response.writeHead(200, {'Content-Type': contentType});
                            response.end(content, 'utf-8');
                        });
                    } else {
                        response.writeHead(500);
                        response.end('Sorry, check with the site admin for error: ' + error.code + ' ..\n');
                        response.end();
                    }
                } else {
                    response.writeHead(200, {'Content-Type': contentType});
                    response.end(content, 'utf-8');
                }
            });

        }).listen(port);
        console.log('server is listening on port ', port)
    }
}
