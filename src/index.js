const path = require('path')
const createBot = require('./tools/bot.js').createBot
const createServer = require("./tools/server.js").createServer;

const bot_token = process.env.discord_bot_token;
(async () => {
    await createBot(bot_token);
    await createServer(process.env.PORT || 5000, path.resolve(process.cwd(), 'dist'));
})();
