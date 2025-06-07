<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!--Head con los links a los estilos y la imagen ico-->
    <title>Formulario de Contacto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/css/contacto.css">
    <link rel="stylesheet" href="../Assets/css/menu.css">
    <link rel="stylesheet" href="../Assets/css/user.css">
    <link rel="icon" href="../Assets/img/ico/Football_2-61_icon-icons.com_72117.ico" type="image/ico">
    <script src="https://cdn.jsdelivr.net/npm/@multiavatar/multiavatar/multiavatar.min.js"></script>
</head>
<body>
     <!--Header con registro y logo de la web-->
<header>
    <a href="index.php">
        <img src="../Assets/img/logo3.png" alt="Logo del blog">
    </a>
    
    <?php require_once './usuario/avatar.php'; ?>

<!--Código menú-->
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
    <div class="container"> <!--Contenedor del formulario y texto-->
        <div class="info">
            <h2>Contáctenos</h2>
            <p>Si tiene algún tipo de error, sugerencia, o necesita ayuda, no dude en ponerse en contacto con nosotros.</p>
            <a href="#">GoalST.empresa@gmail.com</a>
            <a href="#">Gijón, España</a>
        </div>
        <form action="" autocomplete="off"> <!--Formulario de contacto-->
            <input type="text" name="nombre" placeholder="Tu Nombre" class="campo">
            <input type="email" name="email" placeholder="Tu Email" class="campo">
            <textarea name="mensaje" placeholder="Tu Mensaje..."></textarea>
            <input type="submit" name="enviar" value="Enviar Mensaje" class="btn-enviar">
        </form>
    </div>
    <script>
        window.difyChatbotConfig = {
         token: '5ky30dBIXrtByqH7'
        }
       </script>
       <script src="script.js" id="5ky30dBIXrtByqH7" defer></script>
       <script src="../Assets/js/menu-reactivo.js"></script>
       <script src="../Assets/js/ajustes.js"></script>
</body>
</html>