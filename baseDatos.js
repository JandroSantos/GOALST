// ESTE ARCHIVO SOLO ES PARA NODE.JS
const mysql = require('mysql2/promise');

async function initDatabase() {
  const connection = await mysql.createConnection({
    host: '127.0.0.1',
    port: 3306,
    user: 'root',
    password: ''
  });

  await connection.query(`CREATE DATABASE IF NOT EXISTS goalst CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci`);
  await connection.changeUser({ database: 'goalst' });

  await connection.query(`
    CREATE TABLE IF NOT EXISTS users (
      id INT(11) NOT NULL AUTO_INCREMENT,
      username VARCHAR(50) NOT NULL,
      email VARCHAR(100) NOT NULL,
      password VARCHAR(255) NOT NULL,
      avatar_seed VARCHAR(100) DEFAULT NULL,
      failed_attempts INT(11) DEFAULT 0,
      locked_until DATETIME DEFAULT NULL,
      last_login DATETIME DEFAULT NULL,
      created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (id)
    )
  `);

  console.log("✅ Base de datos y tabla 'users' listas.");
  await connection.end();
}

initDatabase().catch(console.error);
