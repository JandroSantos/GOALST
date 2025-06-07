<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GoalST</title>

    <link rel="stylesheet" href="../Assets/css/index.css">
    <link rel="stylesheet" href="../Assets/css/menu.css">
    <link rel="stylesheet" href="../Assets/css/user.css">
    <link rel="shortcut icon" href="../Assets/img/logo3.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Patrick+Hand">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Black+Ops+One">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik+Distressed">
    <link href="https://fonts.googleapis.com/css2?family=Honk&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    
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
    <main>

        <!--Introducción de la página-->
        <h2>Bienvenido a GoalST</h2>
        <div>
            <p>En GoalST, nos apasiona el fútbol y nos dedicamos a proporcionarte las noticias, análisis y contenido
              multimedia más recientes para los aficionados de todo el mundo. Ya seas un seguidor acérrimo de un equipo en
              particular o simplemente un aficionado ocasional.</p>
        </div>

        <p><br></p>
        <p><br></p>

        <!--Donaciones-->
        <a href="paypal.php" style="text-decoration: none;">
           <button class="Btn" id="icono">Donar<svg class="svgIcon" viewBox="0 0 576 512">
           <path d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"></path></svg>
           </button>
        </a>

        <!--Galería con fotos de fútbol-->
        <div class="galeria">
          <div class="panel">
            <img src="../Assets/img/fut_2.jpg" alt="Fútbol">
          </div>
          <div class="panel">
            <img src="../Assets/img/fut_3.jpg" alt="Fútbol" class="img">
          </div>
          <div class="panel">
            <img src="../Assets/img/fut_1_1.jpg" alt="Fútbol">
          </div>
          <div class="panel">
            <img src="../Assets/img/fut_6.jpg" alt="Fútbol">
          </div>
          <div class="panel">
            <img src="../Assets/img/fut_5.jpg" alt="Fútbol" class="img">
          </div>
          <div class="panel">
            <img src="../Assets/img/fut_4.jpg" alt="Fútbol">
          </div>
        </div>
        <div class="imgOculta">
          <img src="../Assets/img/image.png" alt="collage">
        </div>
    </main>
    <script>
      window.difyChatbotConfig = {
       token: '5ky30dBIXrtByqH7'
      }
     </script>
     <script src="script.js" id="5ky30dBIXrtByqH7" defer></script>
     <script src="../Assets/js/menu-reactivo.js"></script>
     <script src="../Assets/js/ajustes.js"></script>
    
    <footer>
        <div class="politica">
            <a href="politica.php" id="icono">
                <p>Política de privacidad</p>
            </a>
            <p>Derechos de autor © 2021 | GoalST</p>
        </div>
    </footer>
</body>
</html>