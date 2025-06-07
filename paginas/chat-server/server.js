const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const db = require('./db');
const cors = require('cors');
const cookieParser = require('cookie-parser');

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
  cors: { origin: "*", methods: ["GET", "POST"] }
});

app.use(cors());
app.use(cookieParser());
app.use(express.json());

app.get('/', (req, res) => {
  res.send('Chat backend funcionando');
});

// Función para escapar HTML (para más seguridad en el backend)
function escapeHTML(str) {
  return str
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

io.on('connection', (socket) => {
  const userName = socket.handshake.auth.username;
  const avatarSeed = socket.handshake.auth.avatarSeed;

  if (!userName) {
    socket.disconnect();
    return;
  }

  console.log(`${userName} se ha conectado.`);
  socket.broadcast.emit('user-connected', userName);

  db.getAllMessages((rows) => {
    socket.emit('chat-history', rows);
  });

  socket.on('chat-message', (message) => {
    const cleanMessage = escapeHTML(message);
    const msgData = {
      user: userName,
      avatarSeed: avatarSeed,
      message: cleanMessage,
      timestamp: new Date().toISOString()
    };

    db.insertMessage(msgData);
    io.emit('chat-message', msgData);
  });

  socket.on('typing', () => {
    socket.broadcast.emit('typing', userName);
  });

  socket.on('disconnect', () => {
    console.log(`${userName} se ha desconectado.`);
    socket.broadcast.emit('user-disconnected', userName);
  });
});

server.listen(3000, () => {
  console.log('Servidor Socket.IO corriendo en puerto 3000');
});
