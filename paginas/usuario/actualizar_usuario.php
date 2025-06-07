<?php
session_start();
require_once 'conf/db.php';

if (!isset($_SESSION['id'])) {
  header('Location: ../login.php');
  exit();
}

$userId = $_SESSION['id'];
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
$avatar = trim($_POST['avatar']);

$updateFields = "username = ?, email = ?";
$params = [$name, $email];

if ($password) {
  $updateFields .= ", password = ?";
  $params[] = $password;
}

if (!empty($avatar)) {
  $updateFields .= ", avatar_seed = ?";
  $params[] = $avatar;
}

$params[] = $userId;

try {
  $stmt = $db->prepare("UPDATE users SET $updateFields WHERE id = ?");
  $stmt->execute($params);
  
  $_SESSION['username'] = $name;

  $_SESSION['avatar_seed'] = $avatar;

  header("Location: ../index.php");
  exit();
} catch (PDOException $e) {
  die("Error al actualizar los datos: " . $e->getMessage());
}
