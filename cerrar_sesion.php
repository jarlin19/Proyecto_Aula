<?php
session_start(); // Iniciar sesión si aún no está iniciada

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio
header("Location: index2.html");
exit();
?>
