<?php
require 'db_conexion.php';
session_start();
 if  (isset($_POST['guardar'])){

    $new_address = $_POST['new_address'];
    $new_address= str_replace(" ","+",$new_address);

    $update = $cnnPDO -> prepare('UPDATE user_address SET direccion = ?');
    $update->execute([$new_address]);

    header('location:sesion.php');

 }
if (isset($_POST['cancelar'])){
    header('location:sesion.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar</title>
</head>
<body>
<div class="form-container">
        <h2>Edita tu direccion</h2>
        <form method="post">
            <label >Nueva Direccion:</label>
            <input type="text"  name="new_address" placeholder="<?php echo $_SESSION['address'];?>" required >

            <input type="submit" name="guardar">

            <a href="sesion.php">Cancelar</a>
        </form>
    </div>
</body>
</html>