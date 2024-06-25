<!DOCTYPE html>
<html>
<head>
    <title>Password recupero</title>
</head>

<body>

<style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.center {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.center h1 {
    text-align: center;
    color: #333;
}

form {
    margin-top: 20px;
    text-align: center;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input[type="email"],
input[type="password"] {
    width: 100%;
    height: 40px;
    padding: 8px;
    margin-top: 5px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

button[type="submit"] {
    width: 100%;
    height: 40px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

a.button {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 20px;
    background-color: #f0f0f0;
    color: #333;
    text-decoration: none;
    border-radius: 3px;
}

a.button:hover {
    background-color: #e0e0e0;
}
</style>

<div class="center">

        <h1>Recuperar</h1>
        <?php
        include("db.php");


        $conex = mysqli_connect("localhost","root","","datos"); 
        
        
        if (isset($_POST['email'])) {
            $email = mysqli_real_escape_string($conex, $_POST['email']);
            $sSql = "SELECT email FROM datos WHERE email = '$email'";
            $result = mysqli_query($conex, $sSql);
            if (mysqli_num_rows($result) == 1) {
              ?>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <input type="hidden" name="email" value="<?php echo $email;?>">
                <br><br>
                Contraseña <br>
                <input type="password" name="passnew"> <br>
                <input type="submit" value="actualizar">
                </form>
                <?php
            } else {
                echo "Email no encontrado";
            }
        } else {
           ?>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <br>
            <button type="submit">Recuperar contraseña</button>
            </form>
            <?php
        }

        if (isset($_POST['passnew'])) {
            $email = mysqli_real_escape_string($conex, $_POST['email']);
            $passnew = password_hash($_POST["passnew"], PASSWORD_DEFAULT);
            $sSql = "UPDATE datos SET password='$passnew' WHERE email = '$email'";
            if (mysqli_query($conex, $sSql)) {
                echo "Contraseña actualizada correctamente";
            } else {
                echo "Error al actualizar contraseña: ". mysqli_error($conex);
            }
        }

        mysqli_close($conex);
       ?>
        <a href="index.php"class="button">Volver</a>
    </div>
   
</body>
</html>