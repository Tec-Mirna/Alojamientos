<?php
session_start();
include './database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];

    $nuevoAlojamiento = [

        'nombre' => $nombre,
        'ubicacion' => $ubicacion,
        'imagen' => $imagen,
        'descripcion' => $descripcion
    ];

  // Se asegura de que $_SESSION['reservations'] sea un array
  if (!isset($_SESSION['reservations']) || !is_array($_SESSION['reservations'])) {
    $_SESSION['reservations'] = [];
}

    $_SESSION['reservations'][] = $nuevoAlojamiento;

     // Guardar en localStorage
     echo "<script>
     let reservations = JSON.parse(localStorage.getItem('reservations')) || [];
     reservations.push(" . json_encode($nuevoAlojamiento) . ");
     localStorage.setItem('reservations', JSON.stringify(reservations));
     window.location.href = 'home.php';
 </script>";

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"><!-- íconos de bootstrap -->
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
<nav class="navbar nav-col">
  <div class="container-fluid">
    <a class="navbar-brand" href="./home.php">
      <img src="https://cdn-icons-png.flaticon.com/512/7602/7602952.png" alt="Logo"  width="40" height="36" class="d-inline-block align-text-top">
      AlojamientoES
    </a>
    <div class="ml-auto">
      <?php if(isset($_SESSION['nombre_completo'])): ?> 
        <span class="navbar-text "><i class="bi bi-person-fill"></i>  <?php echo $_SESSION['nombre_completo']; ?><!-- Mostrar el nombre del usuario de base de datos -->
        <a  href="reservations.php" class="btn position-relative" style="margin-right: 10px;" >Reservas
     
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="reservationCount">
               0
            </span>
         </a>
      </span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a> 
      <?php endif; ?> 
    </div>
  </div>
</nav>

<div class="container">
    <h1 style="color: purple; text-align:center;">Mis Reservas</h1>
    <div id="reservationsContainer"></div>
    <p id="noReservations" style="display:none;">Aún no has hecho reservas.</p>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const reservationsContainer = document.getElementById('reservationsContainer');
    const noReservations = document.getElementById('noReservations');
    const reservationCount = document.getElementById('reservationCount');
    let reservations = JSON.parse(localStorage.getItem('reservations')) || [];

    

       // Función para actualizar el contador de reservas
       function updateReservationCount() {
        reservationCount.textContent = reservations.length;
    }

    // Función para eliminar una reserva
    function cancelReservation(index) {
        reservations.splice(index, 1); 
        localStorage.setItem('reservations', JSON.stringify(reservations)); // Actualiza localStorage
        renderReservations(); // Actualiza la vista
        updateReservationCount(); // Actualiza el contador
    }

    // Función para renderizar las reservas en la vista
    function renderReservations() {
        reservationsContainer.innerHTML = ''; 
        if (reservations.length > 0) {
            reservations.forEach(function(reserva, index) {
                let card = document.createElement('div');
                card.classList.add('card', 'mb-3', 'cards');
                card.innerHTML = `
                    <div class='row g-0'>
                        <div class='col-md-4'>
                            <img src='${reserva.imagen}' class='img-fluid rounded-start' alt='Imagen'>
                        </div>
                        <div class='col-md-8'>
                            <div class='card-body'>
                                <h5 class='card-title'>${reserva.nombre}</h5>
                                <p class='card-text'>
                                <span class='bi bi-geo-alt-fill'></span>${reserva.ubicacion}</p>
                             
                                <button class='btn btn-danger cancel-btn' data-index='${index}' style='position: absolute; bottom: 10px;'>Cancelar</button>
                            </div>
                        </div>
                    </div>`;
                reservationsContainer.appendChild(card);
            });

            // Añade un evento de clic a los botones de cancelar
            document.querySelectorAll('.cancel-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    cancelReservation(index); // Llama a la función para cancelar la reserva
                });
            });
        } else {
            noReservations.style.display = 'block'; // "no hay reservas"
        }
    }

    updateReservationCount();
    renderReservations(); 
});
</script>


</body>
</html>

