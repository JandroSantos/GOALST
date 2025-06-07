<?php

require_once 'conf/db.php';

if (!isset($_SESSION['username'])) {
  header('Location: ../login.php');
  exit();
}

$userId = $_SESSION['id'];
$stmt = $db->prepare("SELECT username, email, avatar_seed FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();
?>

<div id="settingsModal" class="modal">
  <div class="modal-content">
    <h3>Ajustes de Usuario</h3>
    <form id="settingsForm" method="POST" action="./usuario/actualizar_usuario.php">
      <label>Nombre:</label>
      <input type="text" name="name" required value="<?= htmlspecialchars($user['username']) ?>">

      <label>Correo electrónico:</label>
      <input type="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>">

      <label>Contraseña:</label>
      <input type="password" name="password" placeholder="Deja en blanco para no cambiarla">

      <label>Avatar</label><br>
        <?php require_once('../usuario/Multiavatar.php');
          $multiavatar = new Multiavatar();
          $avatarSeed = $user['avatar_seed'] ?? 'default';
          $svgCode = $multiavatar($avatarSeed, null, null); ?>

      <input type="hidden" id="avatarInput" name="avatar" value="<?= htmlspecialchars($avatarSeed) ?>">

      <div id="avatarPreviewContainer">
        <?= $svgCode ?>
      </div>

      <button type="button" onclick="generateRandomAvatar()">Generar Aleatorio</button>

      <button type="submit">Guardar Cambios</button>
      <button type="button" onclick="closeSettingsModal()">Cancelar</button>
    </form>
  </div>
</div>
