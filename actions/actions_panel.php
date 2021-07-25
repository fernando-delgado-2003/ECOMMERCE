<?php 
if(isset($_POST)){
    include("../global/connection.php");
    if(isset($_POST['action']) && $_POST['action'] == "login"){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $query = "SELECT * FROM usuarios WHERE email='$email' AND password='$password' ";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $_SESSION['data_user'] = array(
                'name' => $row['nombre'],
                'level' => $row['nivel'],
                'login' => true
            );
            echo json_encode(array(
                'status' => true,
                'action' => "login"
            ));
        }else{
            echo json_encode(array(
                'status' => false
            ));
        }   
    }elseif(isset($_POST['add_product'])){
        $product_name = $_POST['name'];
        $description = $_POST['description'];
        $img = $_FILES['photo']['name'];
        $price = $_POST['price'];
        $gender = $_POST['gender'];
        $stock = $_POST['stock'];

        // $stock = $_POST['stock'];
        // $offer = $_POST['offer'];
        if(isset($img) || $img != ""){
            $type = $_FILES['photo']['type'];
            $temp = $_FILES['photo']['tmp_name'];
            if(!(strpos($type, 'png') || strpos($type, 'jpeg') ||strpos($type, 'jpg') || strpos($type, 'webp'))){
                echo json_encode(array(
                    "status" => true,
                    "action" => "add_product",
                    "message" => "utulice un formato valido"
                ));
            }else{

                if($gender == "undefined"){
                    $gender = $_POST['gender'] = "unisex";
                }

                $query = "INSERT INTO `producto`(`nombre`, `imagen`, `descripcion`, `genero`, `precio`, `stock`) VALUES ('$product_name','$img','$description','$gender','$price', '$stock')";

                $result = mysqli_query($conn, $query);
                    if($result){
                        move_uploaded_file($temp, '../uploaded_images/'.$img);
                        // header("location: ../panel/productos");
                        echo json_encode(array(
                            "status" => true,
                            "action" => "add_product"
                        ));
                    }else{
                        $error = mysqli_error($conn);
                        echo json_encode(array(
                            "status" => false,
                            "error" => $error,
                            "action" => "add_product"
                        ));
                    }
            }
        }
    }elseif(isset($_POST['update_product'])){
        if($_POST['verify'] == true){
            if(isset($_SESSION['level_user']) && $_SESSION['level_user'] == "admin"){

                $product_name = $_POST['name'];
                $description = $_POST['description'];
                $img = $_FILES['photo']['name'];
                $price = $_POST['price'];
                $gender = $_POST['gender'];
                $stock = $_POST['stock'];
                if($img != ""){
                    $query = "UPDATE `producto` SET `nombre`='$product_name',`imagen`= '$img' ,`descripcion`='$description',`genero`='$gender',`stock`='$stock',`precio`='$price' WHERE `id_producto`='".$_POST['id_product']."'";            
                }else{
                    $query = "UPDATE `producto` SET `nombre`='$product_name',`imagen`= imagen ,`descripcion`='$description',`genero`='$gender',`stock`='$stock',`precio`='$price' WHERE `id_producto`='".$_POST['id_product']."'";       
                }
        
                $result = mysqli_query($conn, $query);

                if($result){
                    $temp = $_FILES['photo']['tmp_name'];

                    move_uploaded_file($temp, '../uploaded_images/'.$img);

                    echo json_encode(array(
                        'status' => true,
                        'action' => 'update_product',
                ));
        }else{
            $error = mysqli_error($conn);
            echo json_encode(array(
                'status' => true,
                'action' => 'update_product',
    
            ));
        }
    }else{
        echo json_encode(array(
            'status' => true,
            'action' => 'update_product',
            'message' => "Upss... No tienes los permisos para eliminar produtos"
        ));
    }
    }
    }elseif(isset($_POST['delete_multiple'])){

        if($_POST['verify'] == true){
            if(isset($_SESSION['level_user']) && $_SESSION['level_user'] == "admin"){
                foreach ($_POST['delete'] as $i => $id) { 
                    $query = "DELETE FROM `producto` WHERE id_producto='$id'";
                    $result = mysqli_query($conn, $query);
                }
                echo json_encode(array(
                    'status' => true,
                    'action' => 'delete_multiple'
                ));
            }else{
                echo json_encode(array(
                    'status' => true,
                    'action' => 'delete_multiple',
                    'message' => "Upss... No tienes los permisos para eliminar produtos"
                ));
            }
        }

        // header("location: ../panel/productos/index.php");
    }
}






?>