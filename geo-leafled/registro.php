<?php
require_once 'db_conexion.php';
if (isset($_POST['registrar'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];

    $sql = $cnnPDO->prepare("INSERT INTO user_leaflet
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <title>Registro</title>
</head>

<body>
    <script>
        // Función para pedir permisos de ubicación al usuario
        function solicitarUbicacion() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Guardar la latitud y longitud en campos ocultos
                    document.getElementById('latitud').value = position.coords.latitude;
                    document.getElementById('longitud').value = position.coords.longitude;
                    
                    cargarMapa(position.coords.latitude, position.coords.longitude)

                }, function(error) {
                    alert('No se pudo obtener la ubicación: ' + error.message);
                });
            } else {
                alert('La geolocalización no está disponible en este navegador.');
            }
        }
        
        // Pedir la ubicación cuando se cargue la página
        window.onload = solicitarUbicacion;
        
        function cargarMapa(latitud, longitud){
    
        let map = L.map('cont-map').setView([latitud, longitud], 20)

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        marker = L.marker([latitud, longitud]).addTo(map);

        map.on('click', clickMapa)

        function clickMapa(e){
            if (marker){
                map.removeLayer(marker)
            }
            document.getElementById('latitud').value = e.latlng.lat
            document.getElementById('longitud').value = e.latlng.lng

            marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);

         
        }
    }
    </script>
    <div class="form-container">
        <h2>Registro</h2>
        <form method="post">
            <label>Nombre Completo:</label>
            <input type="text" name="name" placeholder="Escribe tu nombre" required>

            <label>Correo Electrónico:</label>
            <input type="email" name="email" placeholder="Escribe tu correo" required>

            <label>Contraseña:</label>
            <input type="password" name="pass" placeholder="Escribe tu contraseña" required>

            <input type="hidden" id="latitud" name="latitud">
            <input type="hidden" id="longitud" name="longitud">

            <input type="submit" name="registrar">
        </form>
    </div>

    <div id="cont-map" class="cont-map" style="margin: 20px auto 50px; width: 800px; height:400px; box-shadow:0 3px 15px black"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    

</body>

</html>