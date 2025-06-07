<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head> <!--Head con los links a los estilos y la imagen ico-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/css/resultados.css">
    <link rel="stylesheet" href="../Assets/css/menu.css">
    <link rel="stylesheet" href="../Assets/css/user.css">
    <link rel="icon" href="../Assets/img/ico/Football_2-23_icon-icons.com_72114.ico" type="image/ico">
    <script src="https://cdn.jsdelivr.net/npm/@multiavatar/multiavatar/multiavatar.min.js"></script>
    <title>Resultados</title>
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
    <table id="tablaPartidos" style="display: none;">
        <tr>
            <th>La Liga</th>
        </tr>
        <tbody id="cuerpoTabla_PD"></tbody>

        <tr>
            <th>Premier League</th>
        </tr>
        <tbody id="cuerpoTabla_PL"></tbody>

        <tr>
            <th>Bundesliga</th>
        </tr>
        <tbody id="cuerpoTabla_BL"></tbody>

        <tr>
            <th>Serie A</th>
        </tr>
        <tbody id="cuerpoTabla_SA"></tbody>

        <tr>
            <th>Ligue 1</th>
        </tr>
        <tbody id="cuerpoTabla_Ligue1"></tbody>
    </table>
</main>

<script>
    window.addEventListener("load", (event) => {
        const API_KEY = '2df28265134d4cc5928fa41bcb69811c';
        const fecha = new Date();
        const fechaActual = `2025-05-10`;

        const fin = new Date();
        fin.setDate(fin.getDate() + 7);
        const fechaHasta = `2025-05-17`;
        console.log(fechaActual, fechaHasta);

        // Asegurarse de que los elementos existan antes de trabajar con ellos
        const Tabla_L1 = document.getElementById('cuerpoTabla_Ligue1');
        const Tabla_PD = document.getElementById('cuerpoTabla_PD');
        const Tabla_BL = document.getElementById('cuerpoTabla_BL');
        const Tabla_PL = document.getElementById('cuerpoTabla_PL');
        const Tabla_SA = document.getElementById('cuerpoTabla_SA');

        if (Tabla_L1) Tabla_L1.innerHTML = '';
        if (Tabla_PD) Tabla_PD.innerHTML = '';
        if (Tabla_BL) Tabla_BL.innerHTML = '';
        if (Tabla_PL) Tabla_PL.innerHTML = '';
        if (Tabla_SA) Tabla_SA.innerHTML = '';

        const LIGAS_ID = {
            'PL': 'Premier League',
            'PD': 'La Liga',
            'BL1': 'Bundesliga',
            'SA': 'Serie A',
            'FL1': 'Ligue 1'
        };

        function traducirEstado(estado) {
            const traducciones = {
                'LIVE': 'EN VIVO',
                'FINISHED': 'FINALIZADO',
                'POSTPONED': 'POSPUESTO',
                'CANCELLED': 'CANCELADO'
            };
            return traducciones[estado] || estado;
        }

        async function cargarPartidos() {
            try {
                const url = `https://api.football-data.org/v4/matches?dateFrom=${fechaActual}&dateTo=${fechaHasta}`;
                
                const respuesta = await fetch(url, {
                    headers: {
                        'X-Auth-Token': API_KEY
                    }
                });

                if (!respuesta.ok) {
                    throw new Error('Error en la respuesta de la API');
                }

                const datos = await respuesta.json();

                const partidosFiltrados = datos.matches
                    .filter(partido => LIGAS_ID[partido.competition.code])
                    .sort((a, b) => new Date(a.utcDate) - new Date(b.utcDate));
                    

                


                partidosFiltrados.forEach(partido => {
                    const fechaPartido = new Date(partido.utcDate);
                const fechaEsp = fechaPartido.toLocaleDateString('es-ES', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric',
                    timedone: 'UTC',
                    hour: 'numeric',
                    minute: 'numeric'
                })
                    const fila = document.createElement('tr');
                    
                    const fechaEstado = document.createElement('td');
                    fechaEstado.innerHTML = `
                        ${(fechaEsp)}`
                        if (partido.status === 'LIVE' || partido.status === 'FINISHED' || partido.status === 'POSTPONED' || partido.status === 'CANCELLED'){
                        fechaEstado.innerHTML += `<div class="estado">${traducirEstado(partido.status)}</div>`
                        } else {
                            fechaEstado.innerHTML += ``;
                        }
                

                    const equipos = document.createElement('td');
                    equipos.innerHTML = `<div class="equipos-container">
                            <div class="equipo">
                                <img src="${partido.homeTeam.crest || 'placeholder.png'}" alt="${partido.homeTeam.name}">
                                <span>${partido.homeTeam.name}</span>
                            </div>
                            <div class="equipo" class="equipo-visitante">
                                <span>${partido.awayTeam.name}</span>
                                <img src="${partido.awayTeam.crest || 'placeholder.png'}" alt="${partido.awayTeam.name}">
                            </div>
                        </div>
                    `;

                    const marcador = document.createElement('td');
                    const scoreHome = partido.score.fullTime.home;
                    const scoreAway = partido.score.fullTime.away;
                    marcador.textContent = scoreHome !== null && scoreAway !== null 
                        ? `${scoreHome} - ${scoreAway}`
                        : '--';

                    fila.appendChild(fechaEstado);
                    fila.appendChild(equipos);
                    fila.appendChild(marcador);

                    if (partido.competition.code === 'PD' && Tabla_PD) {
                        Tabla_PD.appendChild(fila);
                    } else if (partido.competition.code === 'PL' && Tabla_PL) {
                        Tabla_PL.appendChild(fila);
                    } else if (partido.competition.code === 'BL1' && Tabla_BL) {
                        Tabla_BL.appendChild(fila);
                    } else if (partido.competition.code === 'SA' && Tabla_SA) {
                        Tabla_SA.appendChild(fila);
                    } else if (partido.competition.code === 'FL1' && Tabla_L1) {
                        Tabla_L1.appendChild(fila);
                    }
                });

                // Mostrar la tabla cuando se hayan agregado los partidos
                const tablaPartidos = document.getElementById('tablaPartidos');
                if (tablaPartidos) {
                    tablaPartidos.style.display = 'table';
                }

                console.log(datos);
            } catch (error) {
                console.error('Error al obtener los partidos:', error);
            }
        }

        cargarPartidos();
    });
</script>
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
