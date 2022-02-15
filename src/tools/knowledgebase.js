const sqlite = require('sqlite3');


class Knowledgebase {
    db;

    constructor() {
        this.db = new sqlite.Database('db.sqlite', console.log, console.log)
    }

    /**
     *
     * @param {Object} query
     */
    query (query) {
        console.log(query)
        return query
    }
}

module.exports = Knowledgebase;
