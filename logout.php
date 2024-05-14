
<?php
session_start(); // Inicia la sesión para acceder a las variables de sesión
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirige al usuario a la página de inicio de sesión u otra página deseada
header("Location: login.php");
exit();
?>