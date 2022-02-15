const fetch = require('node-fetch')
const JSDOM = require('jsdom').JSDOM

module.exports = {
    getEvents: async () => {
        const eventRegister = await (await fetch('https://www.mittelalterkalender.info/mittelaltermarkt/suche-mittelalterfeste.php')).text()
        const parsedDom = new JSDOM(eventRegister)

        const entries = parsedDom.window.document.querySelectorAll('table tbody tr')
        const events = [];

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
        return events
    }
}
