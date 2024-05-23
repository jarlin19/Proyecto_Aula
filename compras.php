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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $direccion = $conn->real_escape_string($_POST['direccion']);
    $ciudad = $conn->real_escape_string($_POST['ciudad']);
    $codigo_postal = $conn->real_escape_string($_POST['codigo-postal']);
    $numero_tarjeta = $conn->real_escape_string($_POST['tarjeta']);
    $fecha_vencimiento = $conn->real_escape_string($_POST['fecha']);
    $cvv = $conn->real_escape_string($_POST['cvv']);
    $fecha_creacion = date("Y-m-d H:i:s");

    // Comprobar si el correo existe en la tabla `usuarios`
    $check_user_sql = "SELECT id FROM usuarios WHERE email = '$email'";
    $result = $conn->query($check_user_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $usuario_id = $row['id'];

        // Si el correo existe, proceder con la inserción
        $sql = "INSERT INTO compras (nombre, email, direccion, ciudad, codigo_postal, numero_tarjeta, fecha_vencimiento, cvv, fecha_creacion, usuario_id) 
                VALUES ('$nombre', '$email', '$direccion', '$ciudad', '$codigo_postal', '$numero_tarjeta', '$fecha_vencimiento', '$cvv', '$fecha_creacion', '$usuario_id')";

        if ($conn->query($sql) === TRUE) {
            // Mostrar mensaje de éxito y redirigir al usuario a index.html
            echo "<script>alert('Compra realizada con éxito');</script>";
            echo "<script>window.location = 'index.html';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: email no válido.";
    }

    $conn->close();
}
?>

