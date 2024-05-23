<?php
session_start(); // Iniciar sesión

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
        // Obtener datos del formulario
        $nombre_usuario = $_POST['loginUsername'];
        $contraseña = $_POST['loginPassword'];

        // Eliminar espacios en blanco al principio y al final
        $nombre_usuario = trim($nombre_usuario);
        $contraseña = trim($contraseña);

        // Consulta SQL para obtener el tipo de usuario
        $sql = "SELECT contraseña, tipo_usuario FROM usuarios WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // Vincular el resultado de la consulta
            $stmt->bind_result($contraseña_hash, $tipo_usuario);
            $stmt->fetch();

            // Verificar si la contraseña es correcta usando password_verify
            if (password_verify($contraseña, $contraseña_hash)) {
                // Redirigir según el tipo de usuario
                if ($tipo_usuario === "usuario") {
                    header("Location: index1.html");
                } elseif ($tipo_usuario === "administrador") {
                    header("Location: index.html");
                }
                exit();
            } else {
                echo "<script>alert('Nombre de usuario o contraseña incorrectos.');</script>";
            }
        } else {
            echo "<script>alert('Nombre de usuario o contraseña incorrectos.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Datos del formulario incompletos.');</script>";
    }
} else {
    echo "<script>alert('No se enviaron datos del formulario con el método POST.');</script>";
}

$conn->close();
?>
