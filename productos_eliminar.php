<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el producto del carrito si existe
    $sql_carrito = "DELETE FROM carrito WHERE producto_id = $id";
    if ($conn->query($sql_carrito) === TRUE) {
        // Ahora eliminar el producto de la tabla productos
        $sql_productos = "DELETE FROM productos WHERE id = $id";
        if ($conn->query($sql_productos) === TRUE) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Error al eliminar el producto: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Error al eliminar el producto del carrito: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "error" => "ID de producto no proporcionado"]);
}

$conn->close();
?>
