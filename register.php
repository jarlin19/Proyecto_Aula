<?php
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
    if (isset($_POST['registerUsername']) && isset($_POST['registerEmail']) && isset($_POST['registerPassword']) && isset($_POST['userType'])) {
        // Obtener datos del formulario
        $nombre = $_POST['registerUsername'];
        $email = $_POST['registerEmail'];
        $contraseña = $_POST['registerPassword'];
        $tipo_usuario = $_POST['userType']; // Cambiado de 'tipo_usuario' a 'userType'

        // Verificar si el email ya está registrado
        $sql = "SELECT id FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('El email ya está registrado.'); window.location.href='register.html';</script>";
            $stmt->close();
            $conn->close();
            exit();
        } else {
            // Encriptar la contraseña
            $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);

            // Insertar datos en la tabla usuarios
            $sql = "INSERT INTO usuarios (username, email, contraseña, tipo_usuario) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $nombre, $email, $contraseña_hash, $tipo_usuario);

            if ($stmt->execute()) {
                // Mostrar mensaje de éxito y redirigir
                echo "<script>alert('Registro exitoso'); window.location.href='iniciosesion.html';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
        }
    } else {
        echo "Error: Datos del formulario incompletos";
    }
} else {
    echo "Error: No se enviaron datos del formulario con el método POST";
}

$conn->close();
?>

