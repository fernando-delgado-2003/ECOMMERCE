<?php 

    if(isset($_POST)){
        if(isset($_POST['pay'])){

            include("../global/connection.php"); 
            $name = $_POST['name'];
            $last_name = $_POST['last_name'];
            $address_1 = $_POST['address_1_'];
            $address_2 = $_POST['address_2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $postcode = $_POST['postcode'];
            $phone = $_POST['phone'];
            $more_inf = $_POST['more_inf'];
            $email = $_POST['email'];
            
            //REGISTRAMOS AL USUARIO SI LLENO EL INPUT DE LA CONTRASEÑA
            if( isset($_POST['password']) && $_POST['password'] != ""){
                $password = $_POST['password'];
                $query = "INSERT INTO `cliente`( `nombre`, `telefono`,  `apellidos`, `email`, `password`) VALUES ('$name', $phone, '$last_name', '$email' , '$password')";
                $result = mysqli_query($conn, $query);
                if($result){
                    $_SESSION['login'] = true;
                    $_SESSION['id_cliente'] = $conn-> insert_id;
                    $_SESSION['data_cliente'] = array(
                        'name' => $name,
                        'last_name' => $last_name,
                        'phone' => $phone,
                        'email' => $email
                    );

                    $_SESSION['message'] = "Sea creado la cuenta exitosamente";

                }else{
                    $_SESSION['message'] = "upss... Hubo un error crear la cuenta";

                }
            }elseif(!isset($_SESSION['id_cliente'])){
                $query = "INSERT INTO `cliente`( `nombre`, `telefono`, `email`) VALUES ('$name', $phone, '$email')";
                $result = mysqli_query($conn, $query);
            }elseif(isset($_SESSION['id_cliente'])){
                $query = "UPDATE `cliente` SET 
                `telefono`= IF(telefono IS NULL OR length(telefono) = 0 , '$phone', telefono) ,
                `apellidos`= IF(apellidos IS NULL OR length(apellidos) = 0 , '$last_name', apellidos) WHERE id_cliente = $id_client";
                mysqli_query($conn, $query);
            }
            //OPTENEMOS EL ID DEL USUARIO QUE ACABAMOS DE REGISTRAR O SE LA SESION SI ESTA REGISTRADO
            if(isset($_SESSION['id_cliente'])){
                $id_client = $_SESSION['id_cliente'];
            }else{
                $id_client = $conn-> insert_id;
            }
            $total = 0;
            //CALCULAMOS EL TOTAL DE LA VENTA
            $info_products = array();

            foreach($_SESSION['cart'] as $i => $product){
                $total = $total + ($product['qty_product']*$product['price_product']);
                $id_product = array();
                $id_product['id'] = $product['id_product'];
                $id_product['qty'] = $product['qty_product'];
                $id_product['price'] = $product['price_product'];
                $id_product['size'] = $product['size'];
                array_push($info_products, $id_product);
            }
            $info_products = json_encode($info_products);
            $fecha = date('Y-m-d h:m:s');

            //REGISTRAMOS LA VENTA
            $query = "INSERT INTO `ventas`(`id_cliente`, `info_producto`, `total`, `fecha`) VALUES ('$id_client', '$info_products', '$total', '$fecha')";

            $result = mysqli_query($conn, $query);
            if($result){
            }else{
                echo mysqli_error($conn);
            }

            $id_venta = $conn-> insert_id;

            //ACTUALIZAMOS EL STOCK DEL PRODUCTO
            foreach($_SESSION['cart'] as $i => $product){
                $qty = $product['qty_product'];
                $id_product = $product['id_product'];

                $query = "UPDATE `producto` SET `stock`=stock-$qty WHERE id_producto='$id_product'";
                mysqli_query($conn, $query);
            }

            $query = "INSERT INTO `envios`
            (`pais`, `direccion`,  `ciudad`, `estado`, `codigo_postal`, `info_adicional_direccion`, `info_adicional_referencia`, `id_venta`)
             VALUES 
            ('méxico', '$address_1', '$city', '$state', '$postcode', '$address_2', '$more_inf', $id_venta)";
            $result = mysqli_query($conn, $query);
            if($result){
                // unset($_SESSION['cart']);
                $_SESSION['id_venta']= $id_venta;
                // header("location: ../pagar.php");
            }
        }
    }
?>