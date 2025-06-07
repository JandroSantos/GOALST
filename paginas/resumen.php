<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
  <head> <!--Head con los links a los estilos-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/css/menu.css">
    <link rel="stylesheet" href="../Assets/css/resumen.css">
    <link rel="stylesheet" href="../Assets/css/user.css">
    <link rel="shortcut icon" href="../Assets/img/ico/videoplayflat_106010.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/@multiavatar/multiavatar/multiavatar.min.js"></script>
    <title>Resúmenes</title>
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
    <div id="videos" class="video-container"></div>

    <script>
        document.addEventListener("DOMContentLoaded", async () => {
    const url = "https://www.scorebat.com/video-api/v3/";
    
    // Diccionario de traducción de nombres de ligas
    const traduccionLigas = {
        "ENGLAND: Premier League": "Inglaterra: Premier League",
        "SPAIN: La Liga": "España: LaLiga",
        "ITALY: Serie A": "Italia: Serie A",
        "GERMANY: Bundesliga": "Alemania: Bundesliga",
        "FRANCE: Ligue 1": "Francia: Ligue 1",
        "EUROPE: Champions League": "Champions League",
        "EUROPE: Champions League, Qualification": "Champions League",
        "EUROPE: Champions League, Play-offs": "Champions League",
        "EUROPE: Champions League, Group Stage": "Champions League",
        "EUROPE: Champions League, Round of 16": "Champions League",
        "EUROPE: Champions League, Quarter-finals": "Champions League",
        "EUROPE: Champions League, Semifinals": "Champions League",
        "EUROPE: Champions League, Semifinal": "Champions League",
        "EUROPE: Champions League, 1/2 final": "Champions League",
        "EUROPE: Champions League, Final": "Champions League",
        "EUROPE: Europa League": "Europa League",
        "EUROPE: Europa League, Qualification": "Europa League",
        "EUROPE: Europa League, Play-offs": "Europa League",
        "EUROPE: Europa League, Group Stage": "Europa League",
        "EUROPE: Europa League, Knockout Round Play-off": "Europa League",
        "EUROPE: Europa League, Round of 16": "Europa League",
        "EUROPE: Europa League, Quarter-finals": "Europa League",
        "EUROPE: Europa League, Semifinals": "Europa League",
        "EUROPE: Europa League, Semifinal": "Europa League",
        "EUROPE: Europa League, 1/2 final": "Europa League",
        "EUROPE: Europa League, Final": "Europa League",
        "EUROPE: Europa Conference League": "Europa Conference League",
        "EUROPE: Europa Conference League, Qualification": "Europa Conference League",
        "EUROPE: Europa Conference League, Play-offs": "Europa Conference League",
        "EUROPE: Europa Conference League, Group Stage": "Europa Conference League",
        "EUROPE: Europa Conference League, Knockout Round Play-off": "Europa Conference League",
        "EUROPE: Europa Conference League, Round of 16": "Europa Conference League",
        "EUROPE: Europa Conference League, Quarter-finals": "Europa Conference League",
        "EUROPE: Conference League, 1/2 final": "Europa Conference League",
        "EUROPE: Europa Conference League, Semifinals": "Europa Conference League",
        "EUROPE: Europa Conference League, Semifinal": "Europa Conference League",
        "EUROPE: Europa Conference League, Final": "Europa Conference League"
    };

    try {
        const response = await fetch(url);
        const data = await response.json();

        if (data.response && Array.isArray(data.response)) {
            const videosFiltrados = data.response.filter(match => Object.keys(traduccionLigas).includes(match.competition));

            const videosContainer = document.getElementById("videos");
            videosContainer.innerHTML = ""; // Limpiar antes de insertar

            videosFiltrados.forEach(match => {
                const nombreLigaTraducido = traduccionLigas[match.competition] || match.competition; // Si no está en el diccionario, deja el original

                const videoCard = document.createElement("div");
                videoCard.classList.add("video-card");

                videoCard.innerHTML = `
                    <h4>${match.title}</h4>
                    <p>${nombreLigaTraducido}</p>
                    <hr>
                    ${match.videos[0].embed}
                `;

                videosContainer.appendChild(videoCard);
            });
            console.log(data.response.map(match => match.competition));

        }
    } catch (error) {
        console.error("Error al obtener los datos:", error);
    }
});
    </script>

        <!--Bot de futbol-->
        <script>
            window.difyChatbotConfig = {
             token: '5ky30dBIXrtByqH7'
            }
           </script>
           <script src="script.js" id="5ky30dBIXrtByqH7" defer></script>
           <script src="../Assets/js/menu-reactivo.js"></script>
           <script src="../Assets/js/ajustes.js"></script>
    </main>
</body>
</html>
