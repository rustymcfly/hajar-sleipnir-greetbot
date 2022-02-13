const bot_token = process.env.discord_bot_token

import Discord, {Intents, MessageEmbed} from 'discord.js'
import fetch from 'node-fetch'
import {JSDOM} from 'jsdom'

const client = new Discord.Client({intents: [Intents.FLAGS.GUILDS, Intents.FLAGS.GUILD_MESSAGES]})

const prefix = "!";

const eventRegister = await (await fetch('https://www.mittelalterkalender.info/mittelaltermarkt/suche-mittelalterfeste.php')).text()
const parsedDom = new JSDOM(eventRegister)

const entries = parsedDom.window.document.querySelectorAll('table tbody tr')
const events = []

entries.forEach((row, index) => {
    events.push({
        id: index,
        from: row.querySelector('td:first-child').textContent.trim(),
        to: row.querySelector('td:nth-child(2)').textContent.trim(),
        name: row.querySelector('td:nth-child(3)').textContent.trim(),
        zip: row.querySelector('td:nth-child(4)').textContent.trim(),
        city: row.querySelector('td:nth-child(5)').textContent.trim(),
        link: row.querySelector('td:nth-child(7) button').getAttribute('formaction')
    })
})
const getChannel = (id) => {
    return client.channels.cache.get(id)
}
client.on("message", (message) => {
    if (message.author.bot) return;
    if (!message.content.startsWith(prefix)) return;

    const commandBody = message.content.slice(prefix.length);
    const args = commandBody.split(' ');
    const command = args.shift().toLowerCase();


    const channel = getChannel(message.channel.id)

    switch (command) {
        case 'ping':
            message.reply(`Pong! This message had a latency of ${Date.now() - message.createdTimestamp}ms.`);
            break
        case 'termine':
            let i = 0;
            const messageCollection = ['']
            events.map(event => {
                if (messageCollection[i] && messageCollection[i].length > 1800) {
                    i++
                }
                if(!messageCollection[i]) {
                    messageCollection[i] = ''
                }
                messageCollection[i] += `${event.id}: ${event.from} ${event.to} in ${event.zip} ${event.city} \r\n`;
            })
            messageCollection.map(item => channel.send(item))
            break
        case 'sum':
            const numArgs = args.map(x => parseFloat(x));
            const sum = numArgs.reduce((counter, x) => counter += x);
            message.reply(`The sum of all the arguments you provided is ${sum}!`);
            break;
        case 'detail':
            const event = events[parseInt(args[0])]
            const embed = new MessageEmbed()
                .setColor('#0099ff')
                .setTitle(event.name)
                .setURL(event.link)

            channel.send({ embeds: [embed] });
    }

});

await client.login(bot_token)