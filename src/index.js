const path = require('path')
const createBot = require('./tools/bot.js').createBot
const createServer = require("./tools/server.js").createServer;

const bot_token = process.env.discord_bot_token;
(async () => {
    await createBot(bot_token);
    await createServer(80, path.resolve(process.cwd(), 'dist'));
})();
