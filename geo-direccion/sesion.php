<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/63c8f1ddb0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="menu container">
            <a href="" class="logo">FoodChi</a>
            <nav class="navbar">
                <ul>
                    <li><a href=""><?php echo $_SESSION['name']; ?></a></li>
                    <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                </ul>
            </nav>
        </div>
        <div class="header-contenido container">
            <h1>Pide comida rapida!</h1>
            <p>Comida rapida a la comidad de tu hogar .</p>
            <a href="#" class="btn-1">Pide ya!</a>
        </div>
    </header>
    <section class="comida">
        <div class="comida-contenido container">
            <h2>Tu Ubicacion actual es esta</h2>
            <p class="txt-p">Mueve el puntero para establecer tu Ubicacion</p>

            <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $_SESSION['latitud']; ?>,<?php echo $_SESSION['longitud']; ?>&output=embed"></iframe> 
 

            <a href="" class="btn-1">Informacion</a>
        </div>
    </section>
</body>

</html>