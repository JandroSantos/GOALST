<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!--Head con los links a los estilos y la imagen ico-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Apóyanos!</title>
    <link  rel="stylesheet" href="../Assets/css/paypal.css">
    <link rel="stylesheet" href="../Assets/css/menu.css">
    <link rel="stylesheet" href="../Assets/css/user.css">
    <link rel="icon" href="../Assets/img/ico/Football_2-25_icon-icons.com_72097.ico" type="image/ico">
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
    <div class="container">
        <div class="card" data-tilt> <!--Con data-tilt se hace la animación-->
          <h2>¡Apóyanos!</h2>
          <p>Contribuye para que nuestro equipo siga marcando goles y ganando partidos.</p>
          <div id="paypal-button-container"></div>
        </div>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=Ae4PK8Lv2YTolmiy91WbRxtKmSE-Uj3Ziezk5QV2NXtZWWveI3YpWDAkGXgSz_228iGbEaLjt0q8knPf&disable-funding=credit,card"></script>
    <script> //Script de paypal para procesar el pago
        paypal.Buttons({
           createOrder: function(data, actions) {
           // Lógica para crear una orden de pago
            return actions.order.create({
             purchase_units: [{
             amount: {
             value: '5.00', // Cantidad del pago
            }
          }]
         });
        },
       onApprove: function(data, actions) {
       // Lógica para procesar la aprobación del pago
       return actions.order.capture().then(function(details) {
       // Lógica para manejar la captura exitosa
       alert('Pago completado. ID de transacción: ' + details.id);
     });
     }
     }).render('#paypal-button-container');
   </script>
 <script src="../Assets/js/vanilla-tilt.js"></script> <!--Script ya creado para el efecto 3D--> 
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