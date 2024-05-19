<?php
session_start(); // Iniciar sesión

require_once './database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];


    // Realizar la consulta SQL para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasenia = '$contrasenia'";
    $result = $conn->query($sql);

    // Verificar si los datos son correctos
    if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION['logged_in'] = true;
      $_SESSION['nombre_completo'] = $row['nombre_completo']; /* Nombre completo del usuario registrado en bd */
      $_SESSION['id_rol'] = $row['id_rol']; // Guardar id del rol en la sesión
    

         /* Verificar al id de rol para verificar si es admin o usuariocomún */
        if ($row['id_rol'] == 1) {
            header("Location: home.php"); // Vista para usuarios comunes
        } elseif ($row['id_rol'] == 2) {
            header("Location: Admin/indexAdmin.php"); // Vista para administradores
        }
        exit();
     } else {
        // Datos incorrectos
        $message = "Usuario o contraseña incorrectos";
     }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Form</title>

    

    <style>
        @import url('https://fonts.googleapis.com/css?family=Muli&display=swap');

      * {
           box-sizing: border-box;
       }

       body {
         background-color: #654ea3;
         color: #fff;
         font-family: 'Muli', sans-serif;
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         height: 100vh;
         overflow: hidden;
         margin: 0;
       }

.container {
  background-color: rgba(0, 0, 0, 0.4);
  padding: 20px 40px;
  border-radius: 5px;
}

.container h1 {
  text-align: center;
  margin-bottom: 30px;
}

.container a {
  text-decoration: none;
  color: lightblue;
}

.btn {
  cursor: pointer;
  display: inline-block;
  width: 100%;
  background: lightblue;
  padding: 15px;
  font-family: inherit;
  font-size: 16px;
  border: 0;
  border-radius: 5px;
}

.btn:focus {
  outline: 0;
}

.btn:active {
  transform: scale(0.98);
}

.text {
  margin-top: 30px;
}

.form-control {
  position: relative;
  margin: 20px 0 40px;
  width: 300px;
}

.form-control input {
  background-color: transparent;
  border: 0;
  border-bottom: 2px #fff solid;
  display: block;
  width: 100%;
  padding: 15px 0;
  font-size: 18px;
  color: #fff;
  position: relative;
  z-index: 100;
}

.form-control input:focus,
.form-control input:valid {
  outline: 0;
  border-bottom-color: lightblue;
}

.form-control label {
  position: absolute;
  top: 15px;
  left: 0;
  pointer-events: none;
}

.form-control label span {
  display: inline-block;
  font-size: 18px;
  min-width: 5px;
  transition: 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.form-control input:focus + label span,
.form-control input:valid + label span {
  color: lightblue;
  transform: translateY(-30px);
}

</style>
</head>
  
  <body>

    <?php if(!empty($message)): ?>
       <div class="alert alert-danger" role="alert"><?php echo $message; ?></div>
    <?php endif; ?>



    <div class="container">
      <h1>Please Login</h1>
      <form action="login.php" method="POST">
        <div class="form-control">
          <input  name="usuario" type="text" required>
          <label>User</label> 
        </div>

        <div class="form-control">
          <input  name="contrasenia" type="password" required>
          <label>Password</label>
        </div>

        <input type="submit" value="Login" class="btn"/>

        <p class="text">Don't have an account? <a href="register.php">Register</a> </p>
      </form>
    </div>
    <script >

       const labels = document.querySelectorAll('.form-control label')

       labels.forEach(label => {
       label.innerHTML = label.innerText
        .split('')
        .map((letter, idx) => `<span style="transition-delay:${idx * 50}ms">${letter}</span>`)
        .join('')
      })
    </script>
  </body>
</html>


