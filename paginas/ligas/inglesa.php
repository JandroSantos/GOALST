<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Assets/css/menu.css">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="../../Assets/css/user.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../../Assets/img/ico/premier/favicon-16x16.png">
    <script src="https://cdn.jsdelivr.net/npm/@multiavatar/multiavatar/multiavatar.min.js"></script>
    <title>Premier League</title>
</head>
<body>
<!--Header con registro y logo de la web-->
<header>
    <a href="../index.php">
        <img src="../../Assets/img/logo3.png" alt="Logo del blog">
    </a>
    
    <?php require_once '../usuario/avatar2.php'; ?>

<!--Código menú-->
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
    <body>
    <div class="slider">
    <div class="thumbnail">
        <div class="item active">
            <a href="../../paginas/ligas/inglesa.php">
            <img src="../../Assets/img/premierLeague.png">
            </a>
        </div>
        <div class="item">
            <a href="../../paginas/ligas/española.php">
            <img src="../../Assets/img/laliga.png">
            </a>
        </div>
        <div class="item">
            <a href="../../paginas/ligas/francesa.php">
             <img src="../../Assets/img/Ligue1.png">
            </a> 
        </div>
        <div class="item">
            <a href="../../paginas/ligas/alemana.php">
            <img src="../../Assets/img/Bundesliga.png">
            </a>
        </div>
        <div class="item">
            <a href="../../paginas/ligas/italiana.php">
            <img src="../../Assets/img/serieA.png">
            </a>
        </div>
    </div>
    </div>

    <div class="container">
        <h1>Premier League 2024/2025</h1>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Equipo</th>
                    <th>J</th>
                    <th>G</th>
                    <th>E</th>
                    <th>P</th>
                    <th>G/F</th>
                    <th>G/C</th>
                    <th>Dif</th>
                    <th>Pts</th>
                </tr>
            </thead>
            <tbody id="cuerpoTabla">
                
            </tbody>
        </table>
    </div>

</main>

<script>
    window.difyChatbotConfig = {
     token: '5ky30dBIXrtByqH7'
    }
</script>

<script src="../script.js" id="5ky30dBIXrtByqH7" defer></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    async function getCompetitionData() {
    const url = "https://api.football-data.org/v4/competitions/PL/standings";
    const apiKey = "2df28265134d4cc5928fa41bcb69811c";

    try {
        const response = await fetch(url, {
            method: "GET",
            headers: {
                "X-Auth-Token": apiKey
            }
        });
        
        if (!response.ok) {
                    throw new Error(`Error: ${response.status} ${response.statusText}`);
                }

                var data = await response.json();
                console.log(data);
                const standings = data.standings[0].table;
                const cuerpoTabla = document.getElementById("cuerpoTabla");

                if (!cuerpoTabla) {
                    console.error("Error: No se encontró el elemento con ID 'cuerpoTabla'");
                    return;
                }

                cuerpoTabla.innerHTML = "";

                standings.forEach(equipo => {
                    const fila = document.createElement("tr");

                    // Asignar clase de color según la posición
                    let clasePosicion = "";
                    if (equipo.position >= 1 && equipo.position <= 4) {
                        clasePosicion = "champions-league";
                    } else if (equipo.position === 5) {
                        clasePosicion = "europa-league";
                    } else if (equipo.position >= 6 && equipo.position <= 7) {
                        clasePosicion = "conference-league";
                    } else if (equipo.position >= 18 && equipo.position <= 20) {
                        clasePosicion = "descenso";
                    }

                    // Agregar la clase solo si aplica
                    if (clasePosicion !== "") {
                        fila.classList.add(clasePosicion);
                    }
        

            fila.innerHTML = `<td>${equipo.position}</td><td class="team-info"><img src="${equipo.team.crest}" alt="${equipo.team.name}">${equipo.team.name}</td><td>${equipo.playedGames}</td><td>${equipo.won}</td><td>${equipo.draw}</td><td>${equipo.lost}</td><td>${equipo.goalsFor}</td><td>${equipo.goalsAgainst}</td><td>${equipo.goalDifference}</td><td>${equipo.points}</td>`;
            
            cuerpoTabla.appendChild(fila);
        });
        
        console.log(data);
    } catch (error) {
        console.error("Error al obtener la clasificación:", error);
    }

//Cogemos el id del equipo que pulsa el usuario para poder mostrar la informacion de este
document.querySelectorAll("tbody tr").forEach((tr, index) => {
    tr.addEventListener("click", () => {
        const equipoId = data.standings[0].table[index].team.id; 
        localStorage.setItem("equipoId", equipoId);  
        console.log(equipoId); 
        window.location.href = "equipo.php";
    });
});

}

getCompetitionData();
});

   </script>
   <script src="../../Assets/js/menu-reactivo.js"></script>
   <script src="../../Assets/js/ajustes.js"></script>
</body>
</html>