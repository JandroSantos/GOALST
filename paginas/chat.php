<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

  $userName = $_SESSION['username'];
  $avatarSeed = $_SESSION['avatar_seed'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Chat</title>
    <link rel="stylesheet" href="../Assets/css/menu.css" />
    <link rel="stylesheet" href="../Assets/css/chat.css" />
    <link rel="stylesheet" href="../Assets/css/user.css">
    <link rel="shortcut icon" href="../Assets/img/ico/chat-48_icon-icons.com_65995.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/@multiavatar/multiavatar/multiavatar.min.js"></script>
    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
    <script src="../Assets/js/chat.js" defer></script>
  </head>

  <body>
    <header>
      <a href="index.php">
        <img src="../Assets/img/logo3.png" alt="Logo del blog" />
      </a>
      
      <?php require_once './usuario/avatar.php'; ?>

    
      <button class="hamburger" id="menu-toggle">&#9776;</button>
      <nav id="main-nav">
        <ul>
          <li><a href="./index.php" id="icono">Inicio</a></li>
          <li><a href="./clasificacion.php">Clasificación</a></li>
          <li><a href="./datos.php" id="icono">Noticias</a></li>
          <li><a href="./chat.php" id="icono">Chat</a></li>
          <li><a href="./resultados.php" id="icono">Resultados</a></li>
          <li><a href="./resumen.php" id="icono">Resúmenes</a></li>
          <li><a href="./contacto.php" id="icono">Contacto</a></li>
        </ul>
      </nav>
    </header>

    <div id="chat">
      <ul id="messages"></ul>
      <form id="form">
        <input type="text" name="message" id="input" placeholder="Escribe un mensaje..." autocomplete="off" />
        <button type="submit">Enviar</button>
      </form>
    </div>

    <script src="../Assets/js/menu-reactivo.js"></script>
    <script src="../Assets/js/ajustes.js"></script>
    <script>
      window.chatUser = <?= json_encode($userName) ?>;
      window.chatAvatarSeed = <?= json_encode($avatarSeed) ?>;
    </script>
  </body>
</html>
