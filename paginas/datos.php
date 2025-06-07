<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/css/menu.css">
    <link rel="stylesheet" href="../Assets/css/goles.css">
    <link rel="stylesheet" href="../Assets/css/user.css">
    <link rel="shortcut icon" href="../Assets/img/ico/report_press_article_media_news_newspaper_icon_262740.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/@multiavatar/multiavatar/multiavatar.min.js"></script>

    <title>Noticias</title>
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
<div class="container">

  <div id="newsContainer" class="news-grid"></div>

  <div class="pagination">
    <button onclick="prevPage()">Anterior</button>
    <button onclick="nextPage()">Siguiente</button>
  </div>
</div>

<script>
  const apiKey = 'aacf3b9075dc4ceabf014037ff629471';
  let page = 1;

  const keywords = [
    "fútbol", "futbol", "Champions League", "Europa League", "Conference League",
    "Premier League", "LaLiga", "Bundesliga", "Serie A", "Ligue 1",
    "Real Madrid", "Barcelona", "Atlético", "Sevilla", "Betis", "Valencia", "Athletic",
    "Manchester United", "Manchester City", "Liverpool", "Chelsea", "Arsenal", 
    "Bayern", "Dortmund", "Juventus", "Inter", "Milan", "PSG", "Marseille",
    "España", "Eurocopa", "Mundial", "Copa del Mundo", "Copa del Rey",
    "Mundial de Clubes", "Copa América", "Nations League"
  ];

  const ignoredSources = ["DW", "Somosxbox", "abc.es", "europapress.es"];

  async function loadNews() {
    const query = keywords.join(" OR ");
    const url = `https://newsapi.org/v2/everything?q=${encodeURIComponent(query)}&language=es&pageSize=20&page=${page}&sortBy=publishedAt&apiKey=${apiKey}`;

    try {
      const res = await fetch(url);
      const data = await res.json();

      if (data.status !== "ok") {
        throw new Error(data.message || "Error en la API");
      }

      const filteredArticles = data.articles.filter(article => {
        const text = `${article.title} ${article.description || ""}`.toLowerCase();
        const source = article.source.name.toLowerCase();
        return (
          keywords.some(keyword => text.includes(keyword.toLowerCase())) &&
          !ignoredSources.some(ignored => source.includes(ignored))
        );
      });

      displayNews(filteredArticles);
    } catch (err) {
      console.error("Error cargando noticias:", err);
      document.getElementById("newsContainer").innerHTML = `<p style="color:red;">Error al cargar noticias: ${err.message}</p>`;
    }
  }

  function displayNews(articles) {
    const container = document.getElementById("newsContainer");
    container.innerHTML = "";

    if (!articles || articles.length === 0) {
      container.innerHTML = "<p>No se encontraron noticias.</p>";
      return;
    }

    articles.forEach(article => {
      const card = document.createElement("div");
      card.className = "news-card";

      const title = document.createElement("div");
      title.className = "news-title";
      title.textContent = article.title;

      const source = document.createElement("div");
      source.className = "news-source";
      source.textContent = article.source.name;

      const content = document.createElement("div");
      content.className = "news-content";
      content.textContent = article.description || article.content || "Sin contenido disponible.";
      content.style.display = "none";

      const link = document.createElement("a");
      link.href = article.url;
      link.target = "_blank";
      link.className = "news-link";
      link.textContent = "Leer artículo completo";

      title.addEventListener("click", () => {
        content.style.display = content.style.display === "none" ? "block" : "none";
      });

      card.appendChild(title);
      card.appendChild(source);
      card.appendChild(content);
      card.appendChild(link);
      container.appendChild(card);
    });
  }

  function nextPage() {
    if (page < 5) {
      page++;
      loadNews();
    }
  }

  function prevPage() {
    if (page > 1) {
      page--;
      loadNews();
    }
  }

  loadNews();
</script>
<script src="../Assets/js/menu-reactivo.js"></script>
<script src="../Assets/js/ajustes.js"></script>
</body>
</html>