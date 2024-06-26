<?php

// Include Configuration File
include('config.php');

$login_button = '';

if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);

        $data = $google_service->userinfo->get();

        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}

// Ancla para iniciar sesión
if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $google_client->createAuthUrl() . '" style=" background: #dd4b39; border-radius: 5px; color: white; display: block; font-weight: bold; padding: 20px; text-align: center; text-decoration: none; width: 200px;">Login With Google</a>';
}


?>
<!DOCTYPE html>
<html lang="es">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PHP Login using Google Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<style>
        .container {
            margin-top: 50px;
        }
        .card {
            margin: 0 auto; 
            float: none; 
            margin-bottom: 10px;
        }
        .rounded-circle {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
</head>
<body>
    <div class="container">
        <br />
        <h2 align="center" style="text-align: center;">Inicio de sesión con <img src="img/logoGoogle.png" alt="Logo Google"></h2>
        <br />
        <div>
            <div class="col-lg-4 offset-lg-4">
                <div class="card">
                    <?php
                    if ($login_button == '') {
                        echo '<div class="card-header">Bienvenido Usuario</div><div class="card-body">';
                        echo '<img src="' . $_SESSION["user_image"] . '" class="rounded-circle container"/>';
                        echo '<h3><b>Nombre :</b> ' . $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'] . '</h3>';
                        echo '<h3><b>Email :</b> ' . $_SESSION['user_email_address'] . '</h3>';
                        echo '<h3><a href="logout.php">Cerrar sesión</a></h3></div>';
                    } else {
                        echo '<div class="card-header">Inicio de Sesión</div><div class="card-body">';
                        echo '<form method="POST" action="hash.php">';
                        echo '<div class="form-group">';
                        echo '<label for="nombre">Nombre de usuario:</label>';
                        echo '<input type="text" class="form-control" id="nombre" name="nombre" required>';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label for="password">Contraseña:</label>';
                        echo '<input type="password" class="form-control" id="password" name="password" required>';
                        echo '</div>';
                        echo '<button type="submit" class="btn btn-primary">Iniciar sesión</button>';
                        echo '</form>';
                        echo '<br>';
                        echo '<div align="center">' . $login_button . '</div>';
                        echo '<div class="text-center">';
                        echo '<a href="registrarse.php">Crear nuevo usuario</a> | ';
                        echo '<a href="newpassword.php">Olvidé mi contraseña</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
</html>

}