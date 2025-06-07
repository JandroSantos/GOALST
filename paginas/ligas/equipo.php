<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../Assets/css/menu.css" />
    <link rel="stylesheet" href="./css/equipo.css" />
    <link rel="stylesheet" href="../../Assets/css/user.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="shortcut icon" href="" type="image/png" />
    <script src="https://cdn.jsdelivr.net/npm/@multiavatar/multiavatar/multiavatar.min.js"></script>
    <title id="nombrePagina"></title>
    <style>
      #map {
        height: 400px;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <header>
      <a href="../index.php">
        <img src="../../Assets/img/logo3.png" alt="Logo del blog" />
      </a>
      
      <?php require_once '../usuario/avatar2.php'; ?>

      <button class="hamburger" id="menu-toggle">&#9776;</button>
      <nav id="main-nav">
        <ul>
          <li><a href="../index.php" id="icono">Inicio</a></li>
          <li><a href="../clasificacion.php">Clasificación</a></li>
          <li><a href="../datos.php" id="icono">Noticias</a></li>
          <li><a href="../chat.php" id="icono">Chat</a></li>
          <li><a href="../resultados.php" id="icono">Resultados</a></li>
          <li><a href="../resumen.php" id="icono">Resúmenes</a></li>
          <li><a href="../contacto.php" id="icono">Contacto</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <div class="container">
        <div class="header">
          <h1 id="team-name">Cargando...</h1>
          <div id="team-details">
            <p id="team-crest"><img src="" alt="Escudo del equipo" /></p>
            <p>
              <strong>Fundado:</strong> <span id="founded">Cargando...</span>
            </p>
            <p>
              <strong>Estadio:</strong> <span id="stadium">Cargando...</span>
            </p>
            <p>
              <strong>Dirección:</strong> <span id="address">Cargando...</span>
            </p>
            <br />
            <hr />
            <br />
            <div id="map"></div>
          </div>
        </div>

        <div class="partidos">
          <div id="proximos-partidos" class="grid"></div>
        </div>

        <div class="players">
          <ul id="lista-jugadores">
            <ul id="porteros">
              <h2>Porteros</h2><br>
            </ul>
            <ul id="defensas">
              <br><h2>Defensas</h2><br>
            </ul>
            <ul id="centrocampistas">
              <br><h2>Centrocampistas</h2><br>
            </ul>
            <ul id="delanteros">
              <br><h2>Delanteros</h2><br>
            </ul>
          </ul>
        </div>
      </div>
    </main>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const id = localStorage.getItem("equipoId");

        async function getTeamData() {
          const url = "https://api.football-data.org/v4/teams/" + id;
          const apiKey = "2df28265134d4cc5928fa41bcb69811c";

          try {
            const response = await fetch(url, {
              method: "GET",
              headers: {
                "X-Auth-Token": apiKey,
              },
            });

            const data = await response.json();

            const team = data;
            document.getElementById("team-name").textContent = team.name;
            document.getElementById(
              "team-crest"
            ).innerHTML = `<img src="${team.crest}" alt="${team.name}">`;
            document.getElementById("founded").textContent = team.founded;
            document.getElementById("stadium").textContent = team.venue;
            document.getElementById("address").textContent = team.address;

            updateFavicon(data.crest);

            function updateFavicon(crestUrl) {
              const favicon = document.querySelector(
                "link[rel='shortcut icon']"
              );

              if (favicon) {
                favicon.href = crestUrl;
              } else {
                console.error("No se aplicó el favicon.");
              }
            }

            var tittle = document.getElementById("nombrePagina");
            tittle.innerHTML = team.name;

            const estadiosProblema = {
              "Atalanta BC": { lat: 45.7083, lon: 9.6789 },
              "Hellas Verona FC": { lat: 45.4351, lon: 10.9683 },
              "Cagliari Calcio": { lat: 39.199756, lon: 9.136415 },
              "US Lecce": { lat: 40.365138, lon: 18.208691 },
              "Venezia FC": { lat: 45.427749, lon: 12.364069 },
              "AC Monza": { lat: 45.583095, lon: 9.307761 },

              "SC Freiburg": { lat: 47.988897, lon: 7.893143 },

              "AJ Auxerre": { lat: 47.78672, lon: 3.588367 },
              "Stade de Reims": { lat: 49.2465, lon: 4.0251 },

              "FC Barcelona": { lat: 41.38026, lon: 2.122014 },
              "Club Atlético de Madrid": { lat: 40.4361, lon: -3.5994 },
              "Rayo Vallecano de Madrid": { lat: 40.3919, lon: -3.6592 },
              "RCD Mallorca": { lat: 39.5895, lon: 2.6286 },
              "Real Sociedad de Fútbol": { lat: 43.3014, lon: -1.9738 },
              "Valencia CF": { lat: 39.4746, lon: -0.3583 },
              "Real Valladolid CF": { lat: 41.6444, lon: -4.7616 },
            };

            async function obtenerCoordenadas(direccion) {
              const url3 = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(
                team.venue
              )}&format=json&limit=1`;

              try {
                const response = await fetch(url3);
                const data = await response.json();

                if (
                  data.length === 0 ||
                  team.name === "Atalanta BC" ||
                  team.name === "FC Barcelona"
                ) {
                  if (team.name in estadiosProblema) {
                    return estadiosProblema[team.name];
                  }
                  console.log(
                    `No se encontraron coordenadas para ${team.name}`
                  );
                  return null;
                }

                const { lat, lon } = data[0];
                return { lat: parseFloat(lat), lon: parseFloat(lon) };
              } catch (error) {
                if (team.name in estadiosProblema) {
                  return estadiosProblema[team.name];
                }
                console.error("Error al obtener coordenadas:", error);
                return null;
              }
            }

            const direccion = team.venue;
            obtenerCoordenadas(direccion).then((coordenadas) => {
              if (!coordenadas) {
                console.error(
                  "No se pudo obtener las coordenadas, el mapa no se cargará."
                );
                return;
              }

              var map = L.map("map").setView(
                [coordenadas.lat, coordenadas.lon],
                16
              );

              L.tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                {
                  attribution: false,
                }
              ).addTo(map);

              L.marker([coordenadas.lat, coordenadas.lon])
                .addTo(map)
                .bindPopup(team.venue)
                .openPopup();
            });

            const posicionesEspanol = {
              Goalkeeper: "Portero",

              Defence: "Defensa",
              "Right-Back": "Lateral Derecho",
              "Left-Back": "Lateral Izquierdo",
              "Centre-Back": "Defensa Central",

              Midfield: "Centrocampista",
              "Central Midfield": "Mediocentro",
              "Attacking Midfield": "Mediapunta",
              "Defensive Midfield": "Pivote",

              Offence: "Delantero",
              "Centre-Forward": "Delantero Centro",
              "Left Winger": "Extremo Izquierdo",
              "Right Winger": "Extremo Derecho",
              Forward: "Delantero",
              Attack: "Delantero",
            };

            const posicionesPorCategoria = {
              Portero: ["Portero"],
              Defensa: [
                "Lateral Derecho",
                "Lateral Izquierdo",
                "Defensa Central",
                "Defensa",
              ],
              Centrocampista: [
                "Mediocentro",
                "Mediapunta",
                "Pivote",
                "Centrocampista",
              ],
              Delantero: [
                "Delantero Centro",
                "Extremo Izquierdo",
                "Extremo Derecho",
                "Delantero",
              ],
            };

            team.squad.forEach(async (player) => {
              const playerItem = document.createElement("li");
              const portero = document.getElementById("porteros");
              const defensa = document.getElementById("defensas");
              const centrocampista = document.getElementById("centrocampistas");
              const delantero = document.getElementById("delanteros");

              const posicionTraducida = posicionesEspanol[player.position];

              playerItem.innerHTML = `${player.name} - ${posicionTraducida}`;

              let categoria = "";
              for (let categorias in posicionesPorCategoria) {
                const posiciones = posicionesPorCategoria[categorias]; // obtener el valor de la categoría (array de posiciones)

                if (posiciones.includes(posicionTraducida)) {
                  categoria = categorias;
                  break;
                }
              }

              switch (categoria) {
                case "Portero":
                  portero.appendChild(playerItem);
                  break;
                case "Defensa":
                  defensa.appendChild(playerItem);
                  break;
                case "Centrocampista":
                  centrocampista.appendChild(playerItem);
                  break;
                case "Delantero":
                  delantero.appendChild(playerItem);
                  break;
              }

              const pais2 = {
                "Cape Verde Islands": "Cabo Verde",
                England: "United Kingdom",
                Scotland: "United Kingdom",
                Wales: "United Kingdom",
                "UA Emirates": "United Arab Emirates",
              };

              if (
                player.nationality == "England" ||
                player.nationality == "Cape Verde Islands" ||
                player.nationality == "Scotland" ||
                player.nationality == "Wales" ||
                player.nationality == "UA Emirates"
              ) {
                player.nationality =
                  pais2[player.nationality] || player.nationality;
              }

              const url2 =
                "https://restcountries.com/v3.1/name/" +
                encodeURIComponent(player.nationality);
              const banderaURL = await obtenerBandera(url2);

              if (banderaURL) {
                playerItem.innerHTML += ` <img src="${banderaURL}" alt="Bandera de ${player.nationality}" width="20">`;
              }
            });
          } catch (error) {
            console.error("Error al obtener los datos del equipo:", error);
          }
        }

        async function obtenerBandera(url2) {
          try {
            const response = await fetch(url2, { method: "GET" });
            const data = await response.json();

            if (!data || data.length === 0) {
              throw new Error("No se encontraron datos del país.");
            }

            const pais = data[0];
            return pais.flags.png;
          } catch (error) {
            console.error("Error al obtener la bandera:", error);
            return null;
          }
        }

        async function getTeamProximosPartidos() {
          const url = "https://api.football-data.org/v4/teams/" + id + "/matches?status=SCHEDULED";
          const apiKey = "2df28265134d4cc5928fa41bcb69811c";
  
          try {
            const response = await fetch(url, {
              method: "GET",
              headers: {
                "X-Auth-Token": apiKey,
              },
            });
  
            const proximosPartidos = await response.json();
  
            console.log(proximosPartidos);
            
            const proximosPartidosContainer = document.getElementById("proximos-partidos");
  
            if(proximosPartidosContainer) proximosPartidosContainer.innerHTML = "";
  
            proximosPartidos.matches.slice(0, 10).forEach((partido) => {
              const partidoDiv = document.createElement("div");
              partidoDiv.classList.add("partido");
            
              const fecha = new Date(partido.utcDate).toLocaleDateString("es-ES", {
                day: "numeric",
                month: "short",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit"
              });
            
              partidoDiv.innerHTML = `
                <div class="equipo">
                  <img src="${partido.homeTeam.crest || 'placeholder.png'}" alt="${partido.homeTeam.name}">
                  <span>${partido.homeTeam.name}</span>
                </div>
                <div class="vs">VS</div>
                <div class="equipo">
                  <img src="${partido.awayTeam.crest || 'placeholder.png'}" alt="${partido.awayTeam.name}">
                  <span>${partido.awayTeam.name}</span>
                </div>
                <div class="fecha">${fecha}</div>
              `;
            
              proximosPartidosContainer.appendChild(partidoDiv);
            });
          } catch (error) {
            console.error("Error al obtener los partidos:", error);
          }            
        }

        getTeamData();
        getTeamProximosPartidos();
      });
    </script>
    <script src="../../Assets/js/menu-reactivo.js"></script>
    <script src="../../Assets/js/ajustes.js"></script>
  </body>
</html>