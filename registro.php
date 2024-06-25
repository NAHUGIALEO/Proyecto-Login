<?php 

include("db.php");

if (isset($_POST['register'])) {
    if (strlen($_POST['nombre']) >= 1 && strlen($_POST['password']) >= 1) {
        $nombre = mysqli_real_escape_string($conex, $_POST['nombre']);
        $email = mysqli_real_escape_string($conex, $_POST['email']);
        $password = $_POST['password'];

        $password = password_hash($password, PASSWORD_DEFAULT, array ('cost' => 10));

        $query = "SELECT * FROM datos WHERE nombre = '$nombre' OR email = '$email'";
        $result = mysqli_query($conex, $query);

        if (mysqli_num_rows($result) > 0) {
           ?>
            <h3 class="bad">¡Ocurrio un error, el nombre de usuario o email ya existen!</h3>
            <?php
        } else {
            $consulta = "INSERT INTO datos(nombre, email, password, ) VALUES ('$nombre','$email', '$password', NOW())";
            $resultado = mysqli_query($conex,$consulta);
            if ($resultado) {
               ?>
                <h3 class="ok">¡Inscripto de manera correcta!</h3>
                <?php
            } else {
               ?>
                <h3 class="bad">¡Error!</h3>
                <?php
            }
        }
    } else {
       ?>
        <h3 class="bad">¡Por favor complete los campos!</h3>
        <?php
    }
}


?>