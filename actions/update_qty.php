<?php 

    if(isset($_POST['qty'])){
        session_start();
        $qty = $_POST['qty'];
        $id_product = $_POST['id_product'];
        // echo $id_product;
        if(is_string($qty) || $qty < 0 || $qty > 10){
            if(isset($_POST['verify_qty'])){
                foreach($_SESSION['cart'] as $i => $product){
                    if($product['id_product'] == $id_product){
                        $qty_respaldo = $_SESSION['cart'][$i]['qty_product'];
                        echo json_encode(array(
                            'success' => true,
                            'qty' => $qty_respaldo
                        ));
                        die();
                    }
                }
            }
        }
        if(is_numeric($id_product) && is_numeric($qty)){
            foreach($_SESSION['cart'] as $i => $product){
                if($product['id_product'] == $id_product){
                    $_SESSION['cart'][$i]['qty_product'] = $qty;
                    echo json_encode(array(
                        'success' => true,
                        'message' => '',
                    ));
                }
            }
        }else{
            echo json_encode(array(
                'success' => false,
                'message' => 'Lo sentimos, no puede comprar mas de 10 unidades',
            ));
        }
        }
?>