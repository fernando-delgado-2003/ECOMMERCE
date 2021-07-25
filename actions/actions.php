<?php
if(isset($_POST)){
    if(isset($_POST['add_cart'])){
        //seteo la vida de la session en 7200 segundos    
  
        include("../global/config.php");
        include("../global/connection.php");
        $id_product = openssl_decrypt($_POST['id_product'], COD, KEY);
        $name_product = openssl_decrypt($_POST['name_product'], COD, KEY);
        $size = openssl_decrypt($_POST['size'], COD, KEY);
        $description_product = openssl_decrypt($_POST['description_product'], COD, KEY);
        $price_product = openssl_decrypt($_POST['price_product'], COD, KEY);
        $qty_product = $_POST['cantidad_product'];
        $img_product = openssl_decrypt($_POST['img_product'], COD, KEY);
        $gender_product = openssl_decrypt($_POST['gender_product'], COD, KEY);
        if(isset($_SESSION['id_cliente']) && $_SESSION['id_cliente'] != ""){
            $id_client =$_SESSION['id_cliente'];
        }else{
            $id_client = NULL;
        }
        // $query = "INSERT INTO `carrito`(`id_cliente`, `id_producto`, `precio`, `cantidad`, `talla`) VALUES ('$id_client', '$id_product', '$price_product', '$qty_product', '$size') ";
        $result = mysqli_query($conn, $query);
                if(!isset($_SESSION['cart'])){
                    $product = array(
                        'id_client' => $id_client,
                        'id_product' => $id_product,
                        'name_product' => $name_product,
                        'description_product' => $description_product,
                        'qty_product' => $qty_product,
                        'img_product' => $img_product,
                        'gender_product' => $gender_product,
                        'price_product' => $price_product,
                        'size' => $size
                    );
                        $_SESSION['cart'][0] =$product;  
                    header("location: ../cart.php");         
                    }else{
                        // guardamos todos los id de los productos 
                        $id_products = array_column($_SESSION['cart'], 'id_product');
                        if(in_array($id_product, $id_products)){
                            $_SESSION['message'] = "El producto ya ha sido seleccionado";
                        }else{
                            $number_product = count($_SESSION['cart']);
                            $product = array(
                                'id_client' => $id_client,
                                'id_product' => $id_product,
                                'name_product' => $name_product,
                                'description_product' => $description_product,
                                'qty_product' => $qty_product,
                                'img_product' => $img_product,
                                'gender_product' => $gender_product,
                                'price_product' => $price_product,
                                'size' => $size
                            );
                            $_SESSION['cart'][$number_product] =$product;  
                        }
            
                    }
                header("location: ../cart.php");  
    }elseif(isset($_POST['delete'])){
        session_start();
        $id_product = $_POST['delete'];
        if(is_numeric($id_product)){
            foreach($_SESSION['cart'] as $i => $product){
                if($product['id_product'] == $id_product){
                    unset($_SESSION['cart'][$i]);
                }
            }
        }else{
            $_SESSION['message'] = "Upss... Hubo un error al eliminar el producto con id ".$id_product;
        }
        header("location: ../cart.php");
    }elseif(isset($_POST['search'])){
        include("../global/connection.php");
        $res = $_POST['search'];
        $_SESSION['search_gender'] = $res;
        $query = "SELECT * FROM producto WHERE genero='$res'";

        $result = mysqli_query($conn, $query);

        $dir = array();
        while($row = mysqli_fetch_array($result)){
            $product = array();

            $product['id_product'] = $row['id_producto'];
            $product['name'] = $row['nombre'];
            $product['description'] = $row['descripcion'];
            $product['img'] = $row['imagen'];
            $product['gender'] = $row['genero'];

         if($row['promo'] == 1){
            $product['price']['promo'] = $row['promo'];
            $product['price']['promo_price'] = $row['precio_promo'];
            $product['price']['price_no_promo'] = $row['precio'];
         }else{
             $product['price'] = $row['precio'];
         }
         array_push($dir, $product);
        }

        echo json_encode(array(
            'success' => true,
            'action' => $res,
            'product' => $dir
        ));   

    }elseif(isset($_POST['search_gender'])){
        if($_POST['search_gender'] != ""){
        include("../global/connection.php");
        include("../include/function/function.php");
            $res = $_POST['search_gender'];
            $_SESSION['search_gender'] = $res;
            $_SESSION['search'] = $res;
            
            $query = search_gender_and_verify_search_order($res);
            $result = mysqli_query($conn, $query);
            $dir = array();
            while ($row = mysqli_fetch_array($result)) {
                $product = array();
               $product['id_product'] = $row['id_producto'];
               $product['name'] = $row['nombre'];
               $product['description'] = $row['descripcion'];
               $product['img'] = $row['imagen'];
               $product['gender'] = $row['genero'];

            if($row['promo'] == 1){
               $product['price']['promo'] = $row['promo'];
               $product['price']['promo_price'] = $row['precio_promo'];
               $product['price']['price_no_promo'] = $row['precio'];
            }else{
                $product['price'] = $row['precio'];
            }
            array_push($dir, $product);
            }
            // $_SESSION['search'] = $dir;
            echo json_encode(array(
                'success' => true,
                'product' => $dir
            ));       
        }

        
    }elseif(isset($_POST['search_order'])){
        if($_POST['search_order'] != ""){
            include("../global/connection.php");
            include("../include/function/function.php");
            $res = $_POST['search_order'];
            $_SESSION['search_order'] = $res;
            $_SESSION['search'] = $res;
            
            $query = search_order_and_verify_search_gender($res);

            $result = mysqli_query($conn, $query);
            $dir = array();
                while($row = mysqli_fetch_array($result)){
                    $product = array();

                    $product['id_product'] = $row['id_producto'];
                    $product['name'] = $row['nombre'];
                    $product['description'] = $row['descripcion'];
                    $product['img'] = $row['imagen'];
                    $product['gender'] = $row['genero'];
     
                 if($row['promo'] == 1){
                    $product['price']['promo'] = $row['promo'];
                    $product['price']['promo_price'] = $row['precio_promo'];
                    $product['price']['price_no_promo'] = $row['precio'];
                 }else{
                     $product['price'] = $row['precio'];
                 }
                 array_push($dir, $product);
                }

                echo json_encode(array(
                    'success' => true,
                    'action' => $res,
                    'product' => $dir
                ));   
 
        }
            
    }elseif(isset($_POST['payment_completed'])){
        $json = json_decode($_POST['data'], true);
        $method = $_POST['method']; 

        if($json['status'] == "COMPLETED"){
            include("../global/connection.php");
            $query = "INSERT INTO `pago`(`id_pago_paypal`, `metodo`, `id_venta`) 
            VALUES ('".$json['id']."', '$method', '".$_SESSION['id_venta']."')";
            $result = mysqli_query($conn, $query);
            $id_pago = $conn->insert_id;
                    $_SESSION['id_pago'] = $conn-> insert_id;
            $query = "UPDATE `ventas` SET `id_pago`=$id_pago WHERE id_venta=".$_SESSION['id_venta']."";
            $result = mysqli_query($conn, $query);
            $_SESSION['data_payment'] = $json;
            unset($_SESSION['cart']);
            echo json_encode(array(
                'success' => true
            )); 
        }
    }

}