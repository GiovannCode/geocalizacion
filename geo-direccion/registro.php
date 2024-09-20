<?php
require_once 'db_conexion.php';
if (isset($_POST['registrar'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $direccion = $_POST['direccion'];
    $direccion = $address = str_replace(" ", "+", $direccion);

    $sql = $cnnPDO->prepare("INSERT INTO user_address
	(email,name, pass, direccion) VALUES (?,?,?,?)");
    $sql->execute([$email, $name, $pass, $direccion,]);
    unset($sql);
    unset($cnnPDO);
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registro</title>
</head>
<body>

<div class="form-container">
        <h2>Registro</h2>
        <form  method="post">
            <label>Nombre Completo:</label>
            <input type="text"  name="name" placeholder="Escribe tu nombre" required>

            <label >Correo Electrónico:</label>
            <input type="email"  name="email" placeholder="Escribe tu correo" required>

            <label>Contraseña:</label>
            <input type="password" name="pass" placeholder="Escribe tu contraseña" required>

            <input type="text" name="direccion" placeholder="Direccion" required>

            <input type="submit" name="registrar">
        </form>
    </div>
</body>
</html>