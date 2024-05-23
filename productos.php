<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen_url = $_POST['imagen_url'];

    // Insertar en la tabla de productos
    $sql_productos = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$imagen_url')";

    if ($conn->query($sql_productos) === TRUE) {
        // Obtener el ID del producto recién insertado
        $producto_id = $conn->insert_id;

        // Insertar en la tabla de carrito
        $sql_carrito = "INSERT INTO carrito (producto_id, cantidad) VALUES ('$producto_id', 1)";

        if ($conn->query($sql_carrito) === TRUE) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Error al agregar al carrito: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Error al agregar el producto: " . $conn->error]);
    }
}

$conn->close();
?>
