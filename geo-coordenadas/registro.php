<?php
require_once 'db_conexion.php';
if (isset($_POST['registrar'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];

    $sql = $cnnPDO->prepare("INSERT INTO user
	(email,name, pass, latitud, longitud) VALUES (?,?,?,?,?)");
    $sql->execute([$email, $name, $pass, $latitud, $longitud]);
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
<script>
        // Función para pedir permisos de ubicación al usuario
        function solicitarUbicacion() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    // Guardar la latitud y longitud en campos ocultos
                    document.getElementById('latitud').value = position.coords.latitude;
                    document.getElementById('longitud').value = position.coords.longitude;
                }, function (error) {
                    alert('No se pudo obtener la ubicación: ' + error.message);
                });
            } else {
                alert('La geolocalización no está disponible en este navegador.');
            }
        }

        // Pedir la ubicación cuando se cargue la página
        window.onload = solicitarUbicacion;
    </script>
<div class="form-container">
        <h2>Registro</h2>
        <form  method="post">
            <label>Nombre Completo:</label>
            <input type="text"  name="name" placeholder="Escribe tu nombre" required>

            <label >Correo Electrónico:</label>
            <input type="email"  name="email" placeholder="Escribe tu correo" required>

            <label>Contraseña:</label>
            <input type="password" name="pass" placeholder="Escribe tu contraseña" required>

            <input type="hidden" id="latitud" name="latitud">
            <input type="hidden" id="longitud" name="longitud">

            <input type="submit" name="registrar">
        </form>
    </div>
</body>
</html>