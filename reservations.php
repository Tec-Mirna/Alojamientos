<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $imagen = $_POST['imagen'];

    $nuevoAlojamiento = [

        'nombre' => $nombre,
        'ubicacion' => $ubicacion,
        'imagen' => $imagen
    ];

  // Se asegura de que $_SESSION['reservations'] sea un array
  if (!isset($_SESSION['reservations']) || !is_array($_SESSION['reservations'])) {
    $_SESSION['reservations'] = [];
}

    $_SESSION['reservations'][] = $nuevoAlojamiento;

        
        header("Location: home.php");

    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <style>
        .nav-col{
            background: #654ea3;
            background: -webkit-linear-gradient(to right, #eaafc8, #654ea3);
            background: linear-gradient(to right, #eaafc8, #654ea3);
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
<!-- Navbar -->
<nav class="navbar nav-col">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">
      <img src="https://cdn-icons-png.flaticon.com/512/7602/7602952.png" alt="Logo" width="40" height="36" class="d-inline-block align-text-top">
      AlojamientoES
    </a>
    <div class="ml-auto">
      <?php if(isset($_SESSION['nombre_completo'])): ?>
        <span class="navbar-text ">  <?php echo $_SESSION['nombre_completo']; ?>
        <button type="button" class="btn position-relative" style="margin-right: 10px;" >Reservas
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?php echo count($_SESSION['reservations']); ?> <!-- contador -->
            </span>
        </button>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<div class="container ">
    <h1 style="color: purple; text-align:center;">Mis Reservas</h1>

    <?php if(isset($_SESSION['reservations']) && count($_SESSION['reservations']) > 0): ?>
        <?php foreach($_SESSION['reservations'] as $reserva): ?>
            <div class='card mb-3 cards' >
                <div class='row g-0'>
                    <div class='col-md-4'>
                        <img src='<?php echo $reserva['imagen']; ?>' class='img-fluid rounded-start' alt='Imagen' >
                    </div>
                    <div class='col-md-8'>
                        <div class='card-body'> <!-- Añade un identificador único -->
                            <h5 class='card-title'><?php echo $reserva['nombre']; ?></h5>
                            <p class='card-text'><?php echo $reserva['ubicacion']; ?></p>
                            <button class="btn btn-danger"  style='position: absolute; bottom: 10px; '>Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
     
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aún no has hecho reservas.</p>
    <?php endif; ?>
</div>




</body>
</html>

