<?php
include 'config.php';  // Conexión a la base de datos

$id = $_GET['id'];  // Obtiene el ID del libro a eliminar

// Cambiar la tabla de jabones a libros
$stmt = $pdo->prepare("DELETE FROM libros WHERE id = ?");
$stmt->execute([$id]);

// Redirecciona a la página principal después de eliminar el libro
header('Location: index.php');
exit;
