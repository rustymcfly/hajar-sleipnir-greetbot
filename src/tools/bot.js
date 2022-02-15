const Discord = require("discord.js");
const getEvents = require("./events.js").getEvents;
const knowledgebase = require('./knowledgebase');
const prefix = "!";
let state = 0;

const client = new Discord.Client({intents: [Discord.Intents.FLAGS.GUILDS, Discord.Intents.FLAGS.GUILD_MESSAGES]});
const Knowledgebase = new knowledgebase()
const getState = () => {
    return client.application
};
const createBot = async function (token) {
    const events = await getEvents();
    const getChannel = (id) => {
        return client.channels.cache.get(id)
    };
    client.on('error', (error) => {
        state = error
    });

    client.on("message", (message) => {
        if (message.author.bot) return;
        if (!message.content.startsWith(prefix)) return;

        const commandBody = message.content.slice(prefix.length);
        const args = commandBody.split(' ');
        const command = args.shift().toLowerCase();


        const channel = getChannel(message.channel.id);

        switch (command) {
            case 'ping':
                message.reply(`Pong! This message had a latency of ${Date.now() - message.createdTimestamp}ms.`);
                break;
            case 'termine':
                let i = 0;
                const messageCollection = [''];
                events.map(event => {
                    if (messageCollection[i] && messageCollection[i].length > 1800) {
                        i++
                    }
                    if (!messageCollection[i]) {
                        messageCollection[i] = ''
                    }
                    messageCollection[i] += `${event.id}: ${event.from} ${event.to} in ${event.zip} ${event.city} \r\n`;
                });
                messageCollection.map(item => channel.send(item));
                break;
            case 'sum':
                const numArgs = args.map(x => parseFloat(x));
                const sum = numArgs.reduce((counter, x) => counter += x);
                message.reply(`The sum of all the arguments you provided is ${sum}!`);
                break;
            case 'detail':
                const event = events[parseInt(args[0])];
                const embed = new Discord.MessageEmbed()
                    .setColor('#0099ff')
                    .setTitle(event.name)
                    .setURL(event.link);

                channel.send({embeds: [embed]});
                break;
            case 'knowledge':
                const query ={}
                query[args.shift()] = args.join(',');
                channel.send(JSON.stringify(Knowledgebase.query(query)));
                break;
            case 'commands':
                channel.send({
                    embeds: [new Discord.MessageEmbed()
                        .setColor('#0099ff')
                        .setImage('https://upload.wikimedia.org/wikipedia/commons/b/bd/Hermodr.jpg')
                        .setTitle('Hermodur Commands')
                        .setDescription('Was kann er denn nun alles?')
                        .setURL('https://harja-sleipnir.herokuapp.com/#/commands')]
                });
                break;
        }

    });

    state = await client.login(token)

};

module.exports = {
    createBot,
    getState
}
