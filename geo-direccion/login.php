<?php
session_start();
require 'db_conexion.php';
if (isset($_POST['iniciar'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $select = $cnnPDO->prepare('SELECT * from user_address WHERE pass =? and email = ?');

    $select->execute([$pass, $email]);
    $count = $select->rowCount();
    $campo = $select->fetch();

    if ($count) {
        $_SESSION['name'] = $campo['name'];
        $_SESSION['email'] = $campo['email'];
        $_SESSION['direccion'] = $campo['direccion'];
      
        header('location:sesion.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="form-container">
        <h2>Iniciar Sesión</h2>
        <form method="post">
            <label >Correo Electrónico:</label>
            <input type="email"  name="email" placeholder="Escribe tu correo" required>

            <label >Contraseña:</label>
            <input type="password"  name="pass" placeholder="Escribe tu contraseña" required>

            <input type="submit" name="iniciar">
        </form>
    </div>
</body>
</html>