<?php 
include("include/function/function.php");
$page = get_page();
@session_start([
    'cookie_lifetime' => 60*60*24*5
]);   
if(isset($_SESSION['search']) && $page != "search" && $_SESSION['search_gender'] != ""){
    unset($_SESSION['search']);
    unset($_SESSION['placeholder_select_gender']['valor']);
    unset($_SESSION['placeholder_select_order']['valor']);
    unset($_SESSION['search_gender']);
    unset($_SESSION['search_order']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/styles-recycling.css">
    <link rel="stylesheet" href="assets/css/responsive.css" type="text/css" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>ecommerce</title>
</head>

<body class="<?php echo $page == "checkout" ? "checkout" : "" ?>">
    <div class="container">
        <header>
            <div class="menu" id="menu">
                <i class='bx bxs-grid'></i>
            </div>
            <h1><a href="index.php">Roby</a></h1>
            <nav id="nav">
                <div class="closed" id="closed">
                <i class='bx bx-x'></i>
                </div>
                <a href="index.php" class="<?php echo $page == "index" ? "active": "" ?>">Inicio</a>
                <form action="search.php" method="POST" id="form-search">
                    <input type="text" name="search" list="search-gender" placeholder="Buscar por genero">
                    <button type="submit" class="icon-search">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
                <datalist id="search-gender">
                    <option value="hombre">Hombre</option>
                    <option value="mujer">Mujer</option>
                    <option value="unisex">Unisex</option>
                    <option value="todo">Todos los productos</option>
                </datalist>
                <?php if(!isset($_SESSION['login'])){?>
                    <a href="login.php">Iniciar sesion</a>
                <?php }?>
                <a href="search.php" class="<?php echo $page == "search" ? "active": "" ?>">Busqueda avanzada</a>
            <div class="icon-shop">
                <a href="cart.php">
                    <i class='bx bx-cart'></i>
                </a>
                <?php if(isset($_SESSION['cart_cont']) && $_SESSION['cart_cont'] > 0){?>
                <div class="cart-cont">
                    <?php echo $_SESSION['cart_cont']; ?>
                </div>
                <?php }?>
            </div>
            <?php if(isset($_SESSION['login'])){?>
            <div class="menu-collapse-user" id="menu-collapse-user">
                    <i class='bx bxs-user-circle'></i>
                    <div class="menu-collapse-content">
                        <!-- <div class="triangle"></div> -->
                        <div>
                            <span>¡Hola, <?php echo $_SESSION['data_cliente']['name']?>!</span>
                            <a href="my-account/">Mi cuenta</a>
                        </div>
                        <a href="my-account/details-account/">Detalles de la cuenta</a>
                        <a href="my-account/orders/">Mis ordenes</a>
                        <a href="closed_session.php">Cerrar sesion</a>
                    </div>
            </div>
            <?php }?>
            </nav>

        </header>