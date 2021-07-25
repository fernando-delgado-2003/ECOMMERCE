<?php

// if(isset($_SESSION['login'])){
//     header("location: ../index.php");
// }else{
//     header("location: ../login.php");
// }

    if(isset($_POST['login_client'])){
            //coneccion
            include("../global/connection.php");

            //datos user
            $email = $_POST['email'];
            $password = $_POST['password'];

            //consulta
            $query = "SELECT * FROM `cliente` WHERE email='$email' AND password='$password'";
            $result = mysqli_query($conn, $query);

            if($row = mysqli_fetch_array($result)){
                // header("location: ../index.php");
                $_SESSION['id_cliente'] = $row['id_cliente'];
                $_SESSION['login'] = true;
                $_SESSION['data_cliente'] = array(
                    'name' => $row['nombre'],
                    'email' => $row['email']
                );
                header("location: ../");

            }else{
                $_SESSION['message'] = "";
                header("location: ../login.php");
                die();
            }

        }
