<?php
session_start();


// session_set_cookie_params(60*60*24*14);
// session_start();


if(isset($_SESSION['login'])){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/form.css">
    <title>Registrarse</title>
</head>

<body>
    <div class="container">
        <form action="actions/auth.php" method="POST">
            <h1>
                Registrarse
            </h1>
            <div class="container-input" data-placeholder="Correo">
                <input type="email" name="email" id="">
            </div>
            <div class="container-input" data-placeholder="Contraseña">
                <input type="password" name="password" id="">
            </div>
            <input type="submit" value="Registrarse" name="register_client">
            <a href="login.php">¿Ya tienes una cuenta?</a>
        </form>
    </div>
</body>

</html>