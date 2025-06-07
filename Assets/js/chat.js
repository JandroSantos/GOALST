document.addEventListener('DOMContentLoaded', () => {
  const socket = io('http://localhost:3000', {
    auth: {
      username: window.chatUser,
      avatarSeed: window.chatAvatarSeed
    }
  });

  const chat = document.getElementById('messages');
  const form = document.getElementById('form');
  const input = document.getElementById('input');

  function escapeHTML(str) {
    return str
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  const createMessageElement = (data) => {
    const container = document.createElement('li');
    container.classList.add('message');

    const avatar = document.createElement('div');
    avatar.classList.add('avatar');
    avatar.innerHTML = window.multiavatar(data.avatarSeed);

    const content = document.createElement('div');
    content.classList.add('content');
    const username = escapeHTML(data.user);
    const message = escapeHTML(data.message);
    content.innerHTML = `<strong>${username}:</strong> ${message}`;

    container.appendChild(avatar);
    container.appendChild(content);
    return container;
  };

  socket.on('chat-message', (data) => {
    const msg = createMessageElement(data);
    chat.prepend(msg);
  });

  socket.on('chat-history', (messages) => {
    messages.reverse().forEach(data => {
      const msg = createMessageElement(data);
      chat.appendChild(msg);
    });
  });

  socket.on('user-connected', (user) => {
    const msg = document.createElement('li');
    msg.textContent = `${user} se ha conectado`;
    chat.prepend(msg);
  });

  socket.on('user-disconnected', (user) => {
    const msg = document.createElement('li');
    msg.textContent = `${user} se ha desconectado`;
    chat.prepend(msg);
  });

  socket.on('typing', (user) => {
    console.log(`${user} está escribiendo...`);
  });

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    if (input.value.trim() !== '') {
      socket.emit('chat-message', input.value.trim());
      input.value = '';
    }
  });

  input.addEventListener('input', () => {
    socket.emit('typing');
  });
});
