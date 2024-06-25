<?php
include('db.php');

$nombre = $_POST['nombre'];
$password = $_POST['password'];
$email = $_POST['email'];

$consulta= "insert into datos (nombre, password, email) values('$nombre', '$password', '$email')";

$resultado= mysqli_query ($conn, $consulta);
    if ($resultado) {
        echo "registrado";
    } else {
        echo "Error al guardar los datos.";
    }
?>
</form>

<a href="index.php"><h2>Logearse</h2></a>
</form>