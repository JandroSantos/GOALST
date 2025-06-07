<?php if (isset($_SESSION['username'])): 
              require_once('../usuario/Multiavatar.php');
              
              $multiavatar = new Multiavatar();
              $avatarSeed = $_SESSION['avatar_seed'] ?? 'default';
              $svgCode = $multiavatar($avatarSeed, null, null);?>

          <div id="userAvatar" class="user-avatar" title="Mi perfil">
            <?= $svgCode ?>
          </div>
    
          <!-- Dropdown del avatar -->
          <div id="avatarDropdown" class="avatar-dropdown">
            <div class="user-info">
              <h4 id="usernameDisplay"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Usuario'); ?></h4>
            </div>
            <button class="dropdown-item" onclick="openSettingsModal()">⚙️ Ajustes</button>
            <button class="dropdown-item logout-btn" onclick="window.location.href='../usuario/logout.php'">⏻ Cerrar Sesión</button>
          </div>
            <?php
                include '../usuario/modal2.php';
            ?>

        <?php else: ?>

          <a href="../login.php" id="usuario" class="usuario">
            <button class="BtnX"></button>
          </a>

        <?php endif; ?>
