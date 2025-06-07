document.addEventListener('DOMContentLoaded', () => {
    const API_KEY = '2df28265134d4cc5928fa41bcb69811c';
    const fecha = new Date();
    const fechaActual = `${fecha.getFullYear()}-${String(fecha.getMonth() + 1).padStart(2, '0')}-${String(fecha.getDate()).padStart(2, '0')}`;

    const fin = new Date();
    fin.setDate(fin.getDate() + 7);
    const fechaHasta = `${fin.getFullYear()}-${String(fin.getMonth() + 1).padStart(2, '0')}-${String(fin.getDate()).padStart(2, '0')}`;
    console.log(fechaActual, fechaHasta);

    const Tabla_L1 = document.getElementById('cuerpoTabla_L1');
    const Tabla_PD = document.getElementById('cuerpoTabla_PD');
    const Tabla_BL = document.getElementById('cuerpoTabla_BL');
    const Tabla_PL = document.getElementById('cuerpoTabla_PL');
    const Tabla_SA = document.getElementById('cuerpoTabla_SA');

    

        Tabla_L1.innerHTML = '';
        Tabla_PD.innerHTML = '';
        Tabla_BL.innerHTML = '';
        Tabla_PL.innerHTML = '';
        Tabla_SA.innerHTML = '';

    const LIGAS_ID = {
        'PL': 'Premier League',
        'PD': 'La Liga',
        'BL1': 'Bundesliga',
        'SA': 'Serie A',
        'FL1': 'Ligue 1'
    };

    function traducirEstado(estado) {
        const traducciones = {
            'TIMED': 'PROGRAMADO',
            'SCHEDULED': 'AGENDADO',
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
            const fila = document.createElement('tr');
            
            const fechaEstado = document.createElement('td');
            fechaEstado.innerHTML = `
                ${(partido.utcDate)}
                <div class="estado">${traducirEstado(partido.status)}</div>
                <div>${LIGAS_ID[partido.competition.code]}</div>
            `;

            const equipos = document.createElement('td');
            equipos.innerHTML = `<div class="equipos-container">
                    <div class="equipo">
                        <img src="${partido.homeTeam.crest || 'placeholder.png'}" alt="${partido.homeTeam.name}">
                        <span>${partido.homeTeam.name}</span>
                    </div>
                    <span>vs.</span>
                    <div class="equipo" class="equipo-visitante">
                        <img src="${partido.awayTeam.crest || 'placeholder.png'}" alt="${partido.awayTeam.name}">
                        <span>${partido.awayTeam.name}</span>
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

            switch (partido.competition.code) {
                case 'PD':
                    Tabla_PD.appendChild(fila);
                    break;
                case 'PL':
                    Tabla_PL.appendChild(fila);
                    break;
                case 'BL1':
                    Tabla_BL.appendChild(fila);
                    break;
                case 'SA':
                    Tabla_SA.appendChild(fila);
                    break;
                case 'FL1':
                    Tabla_L1.appendChild(fila);
                    break;
            }
        });

        tablaPartidos.style.display = 'table';


        console.log(datos);
    } catch (error) {
        console.error('Error al obtener los partidos:', error);
    }
}

cargarPartidos();
});