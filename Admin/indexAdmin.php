<?php

session_start();
include '../database.php';
include './addAccomodation.html';

   // AGREGAR
                                                             //addAccommodation es el name del botón en el modal
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addAccommodation"])) {
    $imagen = $_POST["imagen"];
    $nombre = $_POST["nombre"];
    $ubicacion = $_POST["ubicacion"];
    $descripcion = $_POST["descripcion"];


    $sql = "INSERT INTO alojamientos (imagen, nombre, ubicacion, descripcion) 
    VALUES ('$imagen', '$nombre', '$ubicacion', '$descripcion')";

     // MENSAJES A MOSTRAR LUEGO INSERTAR DATOS 
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Se ha insertado correctamente');
                window.location.href = 'indexAdmin.php'; 
              </script>";
    } else {
      // Manejo de errores si la inserción falla
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
   }
   function checkAdmin() {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['user_role'] !== 'admin') {
        // Si no está autenticado o no es admin, redirigir a una página de error o a home
        header("Location: login.php");
        exit;
    }
  }
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        .nav-col{
           background: #654ea3;  /* fallback for old browsers */
           background: -webkit-linear-gradient(to right, #eaafc8, #654ea3);  /* Chrome 10-25, Safari 5.1-6 */
           background: linear-gradient(to right, #eaafc8, #654ea3); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
        .container{
            margin-top: 30px;
        }
        .cards{
            border: white;
        }
      

    </style>
</head>
<body>

    
     <nav class="navbar nav-col">
       <div class="container-fluid">
         <a class="navbar-brand" >
           <img src="https://cdn-icons-png.flaticon.com/512/7602/7602952.png" alt="Logo" width="40" height="36" class="d-inline-block align-text-top">
           AlojamientoES
          </a>
          <div class="ml-auto">
              <span class="navbar-text "> Administración </span>
              <a href="../logout.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a> 
              </div>
          </div>
       </nav>
       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccommodationModal">
  Añadir Alojamiento
</button>



<table style="max-width: 90%; margin: 0 auto;" class="table table-bordered table-hover">
    <thead>
      <tr>
      <th>Id</th>
      <th>Imagen</th>
      <th>Nombre</th>
      <th>Ubicación</th>
      <th>Descripción</th>
      <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php

    $sql = "SELECT * FROM alojamientos";
    $result = $conn->query($sql);
       
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id_alojamiento']}</td>";   
            echo "<td><img src='{$row['imagen']}' alt='Imagen' style='max-width: 100px;'></td>"; 
            echo "<td>{$row['nombre']}</td>"; 
            echo "<td>{$row['ubicacion']}</td>";  
            echo "<td>{$row['descripcion']}</td>";  
            echo "<td><button class='btn btn-danger'>Eliminar</button></td>";
            echo "</tr>";
        }$conn->close();
        ?>
    </tbody>
</table>
                  
</body>
</html>

