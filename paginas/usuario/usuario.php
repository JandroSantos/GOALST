<?php
session_start(); 

require './conf/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isLogin = isset($_POST['login']);
    $isRegister = isset($_POST['register']);

    $id = isset($_SESSION['id']);
    $userName = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = $isRegister ? trim($_POST['email']) : null;


    if ($isRegister) {
        if (empty($userName) || empty($email) || empty($password)) {
            die("El nombre de usuario, correo y la contraseña son obligatorios.");
        }

        try {
            // Verificar si ya existe el nombre de usuario
            $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
            $stmt->bindValue(':username', $userName, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) {
                die("El nombre de usuario ya existe.");
            }

            // Verificar si ya existe el correo
            $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) {
                die("El correo ya existe.");
            }

            // Hash de la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insertar el nuevo usuario
            $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindValue(':username', $userName, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);

            if ($stmt->execute()) {
                session_start();
                $_SESSION['id'] = $db->lastInsertId();
                $_SESSION['username'] = $userName;
                $_SESSION['message'] = "¡Bienvenido, $userName!";
                header("Location: ../index.php");

                exit;
            } else {
                die("Error al registrar el usuario.");
            }
        } catch (PDOException $e) {
            die("Error en la base de datos. Por favor, inténtalo de nuevo más tarde.");
        }
    }

    if ($isLogin) {
        if (empty($userName) || empty($password)) {
            die("El nombre de usuario y la contraseña son obligatorios.");
        }

        try {
            $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindValue(':username', $userName, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user || !password_verify($password, $user['password'])) {
                echo "Usuario o contraseña incorrectos.";
                exit;
            }

            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }

            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['avatar_seed'] = $user['avatar_seed'];
            $_SESSION['message'] = "¡Bienvenido, $userName!";
            header("Location: ../index.php");
            exit;

        } catch (PDOException $e) {
            die("Error al iniciar sesión. Por favor, inténtalo de nuevo más tarde.");
        }
    }
}
?>
