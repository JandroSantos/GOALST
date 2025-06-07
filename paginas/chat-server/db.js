// Para linux:
// const sqlite3 = require('sqlite3').verbose();
// const db = new sqlite3.Database('./chat.db');

// db.serialize(() => {
//   db.run(`
//     CREATE TABLE IF NOT EXISTS messages (
//       id INTEGER PRIMARY KEY AUTOINCREMENT,
//       user TEXT,
//       avatarSeed TEXT,
//       message TEXT,
//       timestamp TEXT
//     )
//   `);
// });

// module.exports = {
//   insertMessage: ({ user, avatarSeed, message, timestamp }) => {
//     db.run(
//       `INSERT INTO messages (user, avatarSeed, message, timestamp) VALUES (?, ?, ?, ?)`,
//       [user, avatarSeed, message, timestamp]
//     );
//   },
//   getAllMessages: (callback) => {
//     db.all(
//       `SELECT user, avatarSeed, message, timestamp FROM messages ORDER BY id ASC`,
//       (err, rows) => {
//         if (err) return console.error(err);
//         callback(rows);
//       }
//     );
//   }
// };


//para windows: 
// ejecutar en la terminal: npm uninstall sqlite3 y npm install better-sqlite3
const Database = require('better-sqlite3');
const db = new Database('chat.db');
 db.exec(`
   CREATE TABLE IF NOT EXISTS messages (
     id INTEGER PRIMARY KEY AUTOINCREMENT,
     user TEXT,
     avatarSeed TEXT,
     message TEXT,
     timestamp TEXT
   )
 `);

module.exports = {
  insertMessage: ({ user, avatarSeed, message, timestamp }) => {
    const stmt = db.prepare(
      `INSERT INTO messages (user, avatarSeed, message, timestamp) VALUES (?, ?, ?, ?)`
    );
    stmt.run(user, avatarSeed, message, timestamp);
  },

  getAllMessages: (callback) => {
    try {
      const stmt = db.prepare(
        `SELECT user, avatarSeed, message, timestamp FROM messages ORDER BY id ASC`
      );
      const rows = stmt.all();
      callback(rows);
    } catch (err) {
      console.error('Error retrieving messages:', err);
      callback([]);
    }
  }
};