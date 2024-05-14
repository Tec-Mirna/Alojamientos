<?php

include_once './database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_rol = $_POST['id_rol'];
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];
    $nombre_completo = $_POST["nombre_completo"];

    // conuslta SQL para enviar los datos de la base de datos y registrar un usuario, al registrarse por defecto lo hace como usuario común y no admin
    $sql = "INSERT INTO usuarios (id_rol, nombre_completo, usuario, contrasenia) 
    VALUES (2, '$nombre_completo', '$usuario', '$contrasenia')";


     // Ejecutar la consulta
     if ($conn->query($sql) === TRUE) {
       echo "Registro exitoso";
       header("Location: login.php");
       exit();

     } else {
       echo "Error al registrar: " . $conn->error;
     }

    $conn->close();


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <style>

    @import url('https://fonts.googleapis.com/css?family=Muli&display=swap');
 * {
  box-sizing: border-box;
}

body {
  background-color: steelblue;
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
    <div class="container">
        <h1>Create a account</h1>

        <form action="register.php" method="POST">
        <div class="form-control">
            <input type="text" name="nombre_completo" required>
            <label>Nombre completo</label>
        </div>

        <div class="form-control">
            <input type="text" name="usuario" required>
            <label>Nombre de usuario</label>
        </div>

        <div class="form-control">
            <input type="password" name="contrasenia" required>
            <label>Password</label>
        </div>

        <input type="submit" value="Register"><br><br>

       <a href="login.php"> I have an account</a>

       </form>
    </div>

    <script>
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