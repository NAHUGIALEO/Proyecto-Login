<?php

$conex = mysqli_connect("localhost", "root", "", "datos"); 


$usuario = $_POST['nombre'];
$password = $_POST['password'];


$sql = "SELECT * FROM datos WHERE nombre = '$usuario'";
$result = mysqli_query($conex, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row['password'];

    if (password_verify($password, $hashedPassword)) {
        
    
        session_start();
        $_SESSION["nombre"] = $usuario;
        header("Location: exito.php"); //la carpeta "acceso correcto.php" no existe, cambiar a la correspondiente al login correcto del usuario
    } else {
        
        echo "Contraseña incorrecta.";
    }
} else {
   
    echo "Usuario inexistente.";
}

mysqli_close($conex);
?>
