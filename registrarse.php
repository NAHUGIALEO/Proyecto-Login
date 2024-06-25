<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #f0f0f0;
            font-family: 'Poppins', sans-serif;
        }
        form {
            height: auto;
            width: 400px;
            background-color: #ffffff;
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            border: 2px solid #dddddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px 25px;
        }
        form h1 {
            font-size: 28px;
            font-weight: 500;
            text-align: center;
            color: #333333;
        }
        label {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            font-weight: 500;
            color: #333333;
        }
        input {
            display: block;
            height: 45px;
            width: 100%;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
            color: #333333;
            border: 1px solid #dddddd;
            padding: 0 10px;
        }
        input::placeholder {
            color: #999999;
        }
        button, .button {
            margin-top: 20px;
            width: 100%;
            background-color: #333333;
            color: #ffffff;
            padding: 12px 0;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border: none;
        }
        .button {
            background-color: #555555;
        }
        .button:hover {
            background-color: #777777;
        }
    </style>
</head>
<body>
     <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <input type="submit" value="Registrar">
        <a href="index.php" class="button">Volver al inicio</a>

    </form>
   <?php

        $pass_hash= "";
        if(isset($_POST["password"])){
            $pass_hash.=password_hash($_POST["password"], PASSWORD_DEFAULT);
        }
    include("registro.php");
    ?>
</body>
</html>
