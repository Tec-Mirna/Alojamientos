


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlojamientosES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 <style>
  .container{
    margin-top: 30px;
  }
  .nav-col{
    background: #654ea3;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #eaafc8, #654ea3);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #eaafc8, #654ea3); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

  }
  .cards{
    border: white;
  }

 </style>
</head>
<body>
   
<!-- Navbar -->
<?php
session_start();  /* Inicia la sesión y permite acceder a la variable */


// Verificar si 'reservations' está definida y es un array, si no inicializarla como un array vacío
if (!isset($_SESSION['reservations']) || !is_array($_SESSION['reservations'])) {
  $_SESSION['reservations'] = [];
}
?>


<nav class="navbar nav-col">
  <div class="container-fluid">
    <a class="navbar-brand" >
      <img src="https://cdn-icons-png.flaticon.com/512/7602/7602952.png" alt="Logo" width="40" height="36" class="d-inline-block align-text-top">
      AlojamientoES
    </a>
    <div class="ml-auto">
      <?php if(isset($_SESSION['nombre_completo'])): ?> <!-- Verifica si existe la variable  -->
        <span class="navbar-text ">  <?php echo $_SESSION['nombre_completo']; ?><!-- Mostrar el nombre del usuario de base de datos -->
        <a  href="reservations.php" class="btn position-relative" style="margin-right: 10px;" >Reservas
     
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  <?php echo count($_SESSION['reservations']); ?> <!-- Contador -->
            </span>
         </a>
      </span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a> 
      <?php endif; ?> <!-- Si no inicia sesión y no existe la variable de sesión llamada nombre_completo, el bloque no se ejecuta y no se muestra  -->
    </div>
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
  echo "<div class='card mb-3 cards' style='max-width: 418rem;'>";
  echo "<div class='row g-0'>";

  echo " <div class='col-md-4'>";
  echo "<img src='{$row['imagen']}' alt='Imagen'  class='img-fluid rounded-start'>"; 
  echo "</div>";

  echo "<div class='col-md-8'>";
  echo "<div class='card-body' >";
  echo "<h3 class='card-title'>{$row['nombre']}</h3>";
  echo "<p class='card-text'>{$row['ubicacion']}</p>";
  
  echo "<form method='POST' action='reservations.php'>";
  echo "<input type='hidden' name='nombre' value='{$row['nombre']}'>";
  echo "<input type='hidden' name='ubicacion' value='{$row['ubicacion']}'>";
  echo "<input type='hidden' name='imagen' value='{$row['imagen']}'>";
  echo "<button type='submit' class='btn btn-warning btn-sm' style='position: absolute; bottom: 10px;'>Seleccionar</button>";
  echo "</form>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
}    
$conn->close();

?>
