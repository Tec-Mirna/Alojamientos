


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlojamientosES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css">
</head>
<body>
   
<!-- Navbar -->
<?php
session_start();  /* Inicia la sesión y permite acceder a la variable */
?>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="https://cdn-icons-png.flaticon.com/512/7602/7602952.png" alt="Logo" width="40" height="36" class="d-inline-block align-text-top">
      AlojamientoES
    </a>
    <?php if(isset($_SESSION['nombre_completo'])): ?> <!-- Verifica si existe la variable  -->
      <span class="navbar-text"> <?php echo $_SESSION['nombre_completo']; ?></span> <!-- Mostrar el nombre del usuario en base de dats -->
      <a href="logout.php" class="btn btn-outline-light">Cerrar sesión</a> <!-- Enlace para cerrar sesión -->
    <?php endif; ?> <!-- Si no inicia sesion y no existe la variable de sesión llamda nombre_completo el bloque no se ejecuta y no se muestra  -->
  </div>
</nav>


</body>
</html>

<?php
require_once './database.php';


$sql = "SELECT * FROM alojamientos";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div class='container'>";
    echo "<div class='card mb-3' style='max-width: 418rem;'>"; 
    echo "<div class='row g-0'>";
    
    echo " <div class='col-md-4'>";
    echo "<img src='{$row['imagen']}' alt='Imagen'  class='img-fluid rounded-start'>"; // Imagen
    echo "</div>";
    
    echo "<div class='col-md-8'>"; 
    echo "<div class='card-body'>"; 
    echo "<h3 class='card-title'>{$row['nombre']}</h3>"; 
    echo "<p class='card-text'>{$row['ubicacion']}</p>"; 
    echo "<p class='card-text'>{$row['descripcion']}</p>";
    echo "</div>"; 
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>"; 
}    
$conn->close();

?>
