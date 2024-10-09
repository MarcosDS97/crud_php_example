<?php
include 'config.php';  // Conexión a la base de datos

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos enviados desde el formulario
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    try {
        // Consulta SQL para insertar datos en la tabla libros
        $sql = "INSERT INTO libros (autor, editorial, descripcion, precio, stock) VALUES (:autor, :editorial, :descripcion, :precio, :stock)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'autor' => $autor,
            'editorial' => $editorial,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock
        ]);

        $message = 'Libro añadido con éxito!';
    } catch (PDOException $e) {
        $message = 'Error al añadir el libro: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Libro</title>
</head>

<body>
    <h2>Añadir nuevo Libro</h2>

    <?php if (!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <!-- Formulario para añadir un nuevo libro -->
    <form action="create.php" method="post">
        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor" required>
        <br>
        <label for="editorial">Editorial:</label>
        <input type="text" name="editorial" id="editorial" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion"></textarea>
        <br>
        <label for="precio">Precio:</label>
        <input type="text" name="precio" id="precio" required>
        <br>
        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" required>
        <br>
        <input type="submit" value="Añadir Libro">
    </form>

</body>

</html>