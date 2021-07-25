<?php include("include/template/header.php"); ?>

<?php 
    // if(!isset($_SESSION['login'])){
    //     header("location: login.php");
    // }
    //mensage
    if(isset($_SESSION['message'])){?>
<div class="message">
    <?php echo $_SESSION['message']?>
</div>
<?php } unset($_SESSION['message']); ?>

<?php 
    include("include/function/functions_product.php");
    include("global/config.php");

    $array_gender = array(
        'todo' => "Todos los productos",
        'hombre' => 'Tenis: hombre',
        'mujer' => 'Tenis: mujer',
        'unisex' => 'Tenis: unisex',
    );

    $array_order = array(
        'default' => "Orden por defecto",
        'max_price' => 'Ordenar por precio: alto a bajo',
        'min_price' => 'Ordenar por precio: bajo a alto',
        'promo' => 'Productos con promoción',
    );
?>

<section class="search">
    <form>
        <div>
            <select name="search_gender" id="select-search" class="select-search">
                <?php 
                    foreach ($array_gender as $key_gender => $value_gender) {
                        if(isset($_SESSION['search_gender']) && $_SESSION['search_gender'] == $key_gender){ ?>
                <option value="<?php echo $key_gender;?>" selected="true"><?php echo $value_gender; ?></option>
                <?php }else{   ?>
                <option value="<?php echo $key_gender;?>"><?php echo $value_gender; ?></option>
                <?php }} ?>

            </select>
            <span class="placeholder-select">
                <?php 
                if(!isset($_SESSION['search_gender'])){
                    echo $array_gender['todo'];
                }
            ?>
            </span>

            <i class='bx bxs-down-arrow'></i>
        </div>
    </form>

    <form>
        <div>
            <select name="search_order" id="select-order" class="select-search">
                <?php foreach ($array_order as $key_order => $value_order) {
                        if(isset($_SESSION['search_order']) && $_SESSION['search_order'] == $key_order){ ?>
                <option value="<?php echo $key_order;?>" selected="true"><?php echo $value_order; ?></option>
                <?php }else{   ?>
                <option value="<?php echo $key_order;?>"><?php echo $value_order; ?></option>
                <?php }} ?>
            </select>
            <span class="placeholder-select">
                <?php 
                if(!isset($_SESSION['search_order'])){
                    echo $array_order['default'];
                }
            ?>
            </span>
            <i class='bx bxs-down-arrow'></i>
        </div>
    </form>

</section>
<section class="result" id="result">
    <?php 
    
    // Esto es por si el usuario actuliza la pagina
        include("global/connection.php");
        if(isset($_SESSION['search_gender'])){
            $res = $_SESSION['search_gender'];
            $query = search_gender_and_verify_search_order($res);
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result)){
                if($row['promo'] == 1){
                    product_promo($row);
                }else{
                    product_no_promo($row);
                } 
            } 
        }elseif(isset($_SESSION['search_order'])){
            $res = $_SESSION['search_order'];
            $query = search_order_and_verify_search_gender($res);
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result)){
                if($row['promo'] == 1){
                    product_promo($row);
                }else{
                    product_no_promo($row);
                } 
            } 
        }else{
            $result = all_products("global/connection.php");
            while($row = mysqli_fetch_array($result)){
                if($row['promo'] == 1){
                    product_promo($row);
                }else{
                    product_no_promo($row);
                } 
            } 
        }
        
     ?>


</section>
<?php
    function product_no_promo($row){?>
<!-- Producto sin descuento -->
<div class="card">
    <div class="img">
        <img src="uploaded_images/<?php echo $row['imagen'] ?>" alt="">
    </div>
    <div class="inf">
        <h2 class="name"><?php echo $row['nombre'] ?></h2>
        <span class="price">
            <strong class="price-promo">$<?php echo $row['precio']?></strong>
        </span>
        <div class="description">
            <p><?php echo $row['descripcion'] ?></p>
        </div>
        <form class="add" method="GET" action="product.php">
            <input type="hidden" name="id_product" value="<?php echo $row['id_producto'];?>">
            <input type="hidden" name="cantidad_product" value="<?php echo 1?>" />
            <button type="submit" class="view">
                Ver producto
                <i class='bx bx-right-arrow-alt'></i>
            </button>
        </form>
    </div>
</div>
<?php } ?>
<?php
    function product_promo($row){?>
<!-- Producto con descuento -->
<div class="card">
    <div class="img">
        <img src="uploaded_images/<?php echo $row['imagen'] ?>" alt="">
    </div>
    <div class="inf">
        <h2 class="name"><?php echo $row['nombre'] ?></h2>
        <span class="price">
            <del>
                $<?php echo $row['precio'] ?>
            </del>
            <ins>
                <strong class="price-promo">$<?php echo $row['precio_promo']?></strong>
            </ins>
        </span>
        <div class="description">
            <p><?php echo $row['descripcion'] ?></p>
        </div>
        <form class="add" method="GET" action="product.php">
  
            <input type="hidden" name="id_product" value="<?php echo $row['id_producto'];?>">
            <input type="hidden" name="qty_product" value="<?php echo 1?>" />
            <button type="submit" class="view">
                Ver producto
                <i class='bx bx-right-arrow-alt'></i>
            </button>

        </form>
    </div>
</div>
<?php } ?>
<?php include("include/template/footer.php");
?>