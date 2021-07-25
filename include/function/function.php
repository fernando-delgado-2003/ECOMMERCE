<?php 

function get_page(){
    $archive = basename($_SERVER['PHP_SELF']);
    $page = str_replace(".php", "", $archive);
    return $page;
}

function save_id_cliente($conn, $email, $password){
    $query = "SELECT id_cliente FROM cliente WHERE email='$email' AND password='$password' ";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        $_SESSION['id_cliente'] = $row['id_cliente'];
    }
}

function search_order_and_verify_search_gender($res){
    switch ($res) {
            // En cada caso se verifica si hubo una busqueda por genero 
    case 'default':
            if(isset($_SESSION['search_gender']) && $_SESSION['search_gender']!=""){
                $gender = $_SESSION['search_gender'];
                if($gender != "todo"){
                    $query = "SELECT * FROM producto WHERE genero='$gender'";
                }else{
                    $query = "SELECT * FROM producto ";
                }
            }else{
                $query = "SELECT * FROM producto ";
            }
        break;
    case 'max_price':
            if(isset($_SESSION['search_gender']) && $_SESSION['search_gender']!=""){
                $gender = $_SESSION['search_gender'];
                if($gender != "todo"){
                    $query = "SELECT * FROM producto WHERE genero='$gender' ORDER BY precio DESC";
                }else{
                    $query = "SELECT * FROM producto ORDER BY precio DESC";
                }
            }else{
                $query = "SELECT * FROM producto ORDER BY precio DESC";
            }
        break;
    case 'min_price':
            if(isset($_SESSION['search_gender']) && $_SESSION['search_gender']!=""){
                $gender = $_SESSION['search_gender'];
                if($gender != "todo"){
                    $query = "SELECT * FROM producto WHERE genero='$gender' ORDER BY precio ASC";
                }else{
                    $query = "SELECT * FROM producto ORDER BY precio ASC";
                }
            }else{
                $query = "SELECT * FROM producto ORDER BY precio ASC";
            }
        break;
    case 'promo':
            if(isset($_SESSION['search_gender']) && $_SESSION['search_gender']!=""){
                $gender = $_SESSION['search_gender'];
                if($gender != "todo"){
                    $query = "SELECT * FROM producto WHERE genero='$gender' AND promo=1 ORDER BY precio ASC";
                }else{
                    $query = "SELECT * FROM producto WHERE promo=1 ";
                }
            }else{
                $query = "SELECT * FROM producto WHERE promo=1 ";
            }
        break;
    }
    return $query;
}
function search_gender_and_verify_search_order($res){
    if($res == "todo"){
        if(isset($_SESSION['search_order']) && $_SESSION['search_order']!=""){
            $order = $_SESSION['search_order'];
            switch($order){
                case 'max_price':
                    $query = "SELECT * FROM producto ORDER BY precio DESC";
                break;
                case 'min_price':
                    $query = "SELECT * FROM producto ORDER BY precio ASC";
                break;
                case 'promo':
                    $query = "SELECT * FROM producto WHERE promo=1";
                break;
                case 'default':
                    $query = "SELECT * FROM producto";
                break;
            }
        }else{
            $query = "SELECT * FROM producto";
        }
    }else{
        if(isset($_SESSION['search_order']) && $_SESSION['search_order']!=""){
            $order = $_SESSION['search_order'];
            switch($order){
                case 'max_price':
                    $query = "SELECT * FROM producto WHERE genero='$res' ORDER BY precio DESC";
                    break;
                case 'min_price':
                    $query = "SELECT * FROM producto WHERE genero='$res' ORDER BY precio ASC";
                break;
                case 'promo':
                    $query = "SELECT * FROM producto WHERE genero='$res' AND promo=1";
                break;
                case 'default':
                    $query = "SELECT * FROM producto WHERE genero='$res'";
                break;
            }
        }else{
            $query = "SELECT * FROM producto WHERE genero='$res'";
        }
    }   
return $query; 
}

?>