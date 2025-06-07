<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<!--Head con los links a los estilos-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>clasificación</title>
    <link rel="stylesheet" href="../Assets/css/menu.css">
    <link rel="stylesheet" href="../Assets/css/clasificacion.css">
    <link rel="stylesheet" href="../Assets/css/user.css">
    <link rel="shortcut icon" href="../Assets/img/ico/Football_2-31_icon-icons.com_72101.ico" type="image/x-icon">
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
    <div class="slider">
        <!--Fondo de pantalla de cada liga-->
        <div class="list">
            <div class="item active">
                <img src="../Assets/img/premier2.jpg">
                <div class="content">
                    <h2>PREMIER LEAGUE</h2> 
                </div>
            </div>
            <div class="item">
                <img src="../Assets/img/laliga2.jpg">
                <div class="content">
                    <h2>LA LIGA</h2>
                </div>
            </div>
            <div class="item">
                <img src="../Assets/img/ligue12.jpg">
                <div class="content">
                    <h2>LIGUE 1</h2>
                </div>
            </div>
            <div class="item">
                <img src="../Assets/img/Bundesliga2.jpg">
                <div class="content">
                    <h2>BUNDESLIGA</h2>
                </div>
            </div>
            <div class="item">
                <img src="../Assets/img/seriea1.jpg">
                <div class="content">
                    <h2>SERIE A</h2>
                </div>
            </div>
        </div>
        <!-- Flechas de selección de página -->
        <div class="arrows">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <!-- Cuadrados de selección de página con logo de la liga -->
        <div class="thumbnail">
            <div class="item active">
                <a href="../paginas/ligas/inglesa.php">
                <img src="../Assets/img/premierLeague.png">
                </a>
                <div class="content">
                </div>
            </div>
            <div class="item">
                <a href="../paginas/ligas/española.php">
                <img src="../Assets/img/laliga.png">
                </a>
                <div class="content">
                </div>
            </div>
            <div class="item">
                <a href="../paginas/ligas/francesa.php">
                 <img src="../Assets/img/Ligue1.png">
                </a> 
                 <div class="content">
                 </div>
            </div>
            <div class="item">
                <a href="../paginas/ligas/alemana.php">
                <img src="../Assets/img/Bundesliga.png">
                </a>
                <div class="content">
                </div>
            </div>
            <div class="item">
                <a href="../paginas/ligas/italiana.php">
                <img src="../Assets/img/serieA.png">
                </a>
                <div class="content">
                </div>
            </div>
        <script src="../Assets/js/ligas.js"></script>
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
