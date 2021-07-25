<?php 
    if(isset($_GET['id_product'])){
    include("global/config.php");
    include("global/connection.php");
        $id_product = $_GET['id_product'];
        if(!is_numeric($_GET['qty_product'])){
            header("location: product.php?id_product=".$id_product."&qty_product=1");
        }
        if($_GET['qty_product'] > 10 || $_GET['qty_product'] < 0){
            header("location: product.php?id_product=".$id_product."&qty_product=1");

        }
        $qty_product = $_GET['qty_product'];
    }else{
        header("location:index.php");
    }
?>
<?php include("include/template/header.php")?>
<div class="container-product">
    <?php 
        $query = "SELECT * FROM producto WHERE id_producto='$id_product'";
        $result = mysqli_query($conn, $query);
        while($row_product = mysqli_fetch_array($result)){
            if($row_product['promo']){
                $price = $row_product['precio_promo'];
            }else{
                $price = $row_product['precio'];
            }
    ?>
    <div class="container-img text-center">
        <img src="uploaded_images/<?php echo $row_product['imagen']?>" alt="">
    </div>
    <div class="inf-product text-center">
        <div class="gender">
            tenis:
        <?php echo $row_product['genero']?>
        </div>
        <h1>
            <?php echo $row_product['nombre']?>
        </h1>
        <form action="actions/actions.php" method="POST">
            <div class="container-count-and-size">

                <div class="count" id="count form-product">
                    <div>
                        <i class='bx bx-plus'></i>
                    </div>
                    <input type="text" name="cantidad_product" id="result" value="<?php echo $qty_product?>">
                    <div>
                        <i class='bx bx-minus'></i>
                    </div>
                </div>
                <div class="size">
                    <select name="size" id="">

                        <?php 
                                if($row['genero'] == "women"){
                                   $query = "SELECT * FROM talla WHERE talla <= 27"; 
                                }else{
                                    $query = "SELECT * FROM talla WHERE talla <= 30"; 
                                }
                            

                            $result = mysqli_query($conn, $query);

                            while($row = mysqli_fetch_array($result)){
                        ?>
                        <option value="<?php echo openssl_encrypt($row['talla'], COD, KEY)?>"><?php echo $row['talla']; ?> </option>
                        <?php }?>
                    </select>
                    <i class='bx bxs-down-arrow'></i>
                </div>
            </div>
            <p>
                <?php echo $row_product['descripcion']?>
            </p>
            <input type="hidden" name="id_product" value="<?php echo openssl_encrypt($row_product['id_producto'], COD, KEY)?>">
            <input type="hidden" name="name_product" value="<?php echo openssl_encrypt($row_product['nombre'], COD, KEY)?>">
            <input type="hidden" name="img_product" value="<?php echo openssl_encrypt($row_product['imagen'], COD, KEY)?>">
            <input type="hidden" name="description_product" value="<?php echo openssl_encrypt($row_product['descripcion'], COD, KEY)?>">
            <input type="hidden" name="price_product" value="<?php echo openssl_encrypt($price, COD, KEY)?>">
            <input type="hidden" name="gender_product" value="<?php echo openssl_encrypt($row_product['genero'], COD, KEY)?>">

            <!-- botones -->
            <input type="submit" value="Agregar al carrito" class="black" name="add_cart">

        </form>
    </div>
    <?php }?>
    <?php if(mysqli_num_rows($result) == 0){
        header("location:index.php");
    }?>
</div>

<?php include("include/template/footer.php")?>