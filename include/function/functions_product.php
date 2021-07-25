<?php 
      
function all_products($url_page){
    include($url_page);
    $query_products = "SELECT * FROM `producto`";

    $result = mysqli_query($conn, $query_products);
    return $result;
}

function products_sale($url_page, $limit_result){
    include($url_page);
    $query_products = "SELECT * FROM `producto` WHERE promo=1 ORDER BY precio_promo";

    $result = mysqli_query($conn, $query_products);
    return $result;
}

function order_random($url_page, $limit_result){
    include($url_page);
    $query_products = "SELECT * FROM `producto` ORDER BY RAND() LIMIT $limit_result";

    $result = mysqli_query($conn, $query_products);
    return $result;
}

function products_woman($url_page, $limit_result){
    include($url_page);
    if($limit_result == ""){
        $query_products = "SELECT * FROM `producto` WHERE genero = 'mujer'";
    }else{
        $query_products = "SELECT * FROM `producto` WHERE genero = 'mujer'  LIMIT $limit_result";
    }

    $result = mysqli_query($conn, $query_products);
    return $result;
}
function products_man($url_page){
    include($url_page);
    $query_products = "SELECT * FROM `producto` WHERE genero = 'hombre'";

    $result = mysqli_query($conn, $query_products);
    return $result;
}
function products_unisex($url_page){
    include($url_page);
    $query_products = "SELECT * FROM `producto` WHERE genero = 'unisex'";

    $result = mysqli_query($conn, $query_products);
    return $result;
}
//
function products_min_price($url_page){
    include($url_page);
    $query_products = "SELECT * FROM producto ORDER BY precio ASC";

    $result = mysqli_query($conn, $query_products);
    return $result;
}
function products_max_price($url_page){
    include($url_page);
    $query_products = "SELECT * FROM producto ORDER BY precio DESC ";

    $result = mysqli_query($conn, $query_products);
    return $result;
}
function products_promo($url_page){
    include($url_page);
    $query_products = "SELECT * FROM producto WHERE promo=1";

    $result = mysqli_query($conn, $query_products);
    return $result;
}

function cart_client($url_page, $id_cliente){
    include($url_page);
    $query_products = "SELECT * FROM `carrito` id_cliente='$id_cliente'";
    $result = mysqli_query($conn, $query_products);
    return $result;
}
?>