<?php
include 'config.php';

// Comprobando si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id = $_POST['id'];

    // Consulta SQL para actualizar los datos del libro
    $stmt = $pdo->prepare("UPDATE libros SET autor = ?, editorial = ?, descripcion = ?, precio = ?, stock = ? WHERE id = ?");
    $stmt->execute([$autor, $editorial, $descripcion, $precio, $stock, $id]);

    header('Location: index.php');
    exit;
}

// Obtener el ID del libro a editar
$id = $_GET['id'];
$stmt = $pdo->query("SELECT * FROM libros WHERE id = $id");
$libro = $stmt->fetch();

?>

<h2>Editar Libro</h2>

<!-- Formulario para editar un libro -->
<form action="edit.php" method="post">
    <input type="hidden" name="id" value="<?php echo $libro['id']; ?>">
    Autor: <input type="text" name="autor" value="<?php echo $libro['autor']; ?>"><br>
    Editorial: <input type="text" name="editorial" value="<?php echo $libro['editorial']; ?>"><br>
    Descripción: <textarea name="descripcion"><?php echo $libro['descripcion']; ?></textarea><br>
    Precio: $<input type="text" name="precio" value="<?php echo $libro['precio']; ?>"><br>
    Stock: <input type="number" name="stock" value="<?php echo $libro['stock']; ?>"><br>
    <input type="submit" value="Guardar Cambios">
</form>