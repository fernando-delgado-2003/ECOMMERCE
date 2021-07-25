<?php include("include/template/header.php")?>
<?php

?>
<?php 
if(isset($_SESSION['search_gender']) && $_SESSION['search_gender'] != ""){
    unset($_SESSION['search_gender']);
}
    if(isset($_SESSION['message'])){?>
<div class="message">
    <?php echo $_SESSION['message']?>
</div>
<?php } unset($_SESSION['message']); 
    if(!isset($_SESSION['login'])){
        unset($_SESSION);
    }
?>

<main>
    <section class="home" id="home">

        <div class="img-home">
            <img src="assets/img/imghome.png" alt="" />
        </div>


        <div class="text-home">
            <p class="new-home">Nuevo</p>
            <h2 class="title-home">YEESY BOOST SPLY-350</h2>
            <p class="description-home"></p>
            <button type="button" class="button-black">Ver ahora</button>
            <p>*Baner ilustrativo*</p>
        </div>
    </section>



    <section id="featured" class="featured">
        <div class="line"></div>
        <h2 class="title-sections">Oferta</h2>
        <section class="section-featured">
            <div class="container-cards">
                <?php 
              include("include/function/functions_product.php");
              include("global/config.php");

              $result = products_sale("global/connection.php", 4);
              while($row = mysqli_fetch_array($result)){
                ?>
                <div class="card">
                    <div class="sale">
                        <p>OFERTA</p>
                    </div>
                    <div class="card-img">
                        <img src="uploaded_images/<?php echo $row['imagen']?>" alt="" class="rotate" />
                    </div>

                    <div class="card-text">
                        <h2><?php echo $row['nombre']?></h2>
                        <p>$<?php echo $row['precio_promo']?></p>
                        <form class="add" method="GET" action="product.php">
                            <!-- 
                            En esta ocacion quise pasar todos los datos de una en vez de solo el id del producto, para evitar hacer otra consulta a la base de datos 
                        -->
                            <input type="hidden" name="id_product" value="<?php echo $row['id_producto'];?>">
                            <input type="hidden" name="qty_product" value="<?php echo 1?>" />


                            <button type="submit">
                                Ver producto
                                <i class='bx bx-right-arrow-alt'></i>

                            </button>
                        </form>
                    </div>
                </div>
                <?php }?>

                <!-- <section class="marcas grid">
            <div class="card">
              <h2>Nike</h2>
              <p class="new">New collection 2021</p>
              <div class="buy">
                <p>Buy now</p>
                <i class='bx bx-right-arrow-alt' ></i>
              </div>
            </div>
            <div class="card">
              <h2>addidas</h2>
              <p class="new">New collection 2021</p>
              <div class="buy">
                <p>Buy now</p>
                <i class='bx bx-right-arrow-alt' ></i>
              </div>
            </div>

          </section> -->
        </section>
    </section>


    <section id="women" class="women">
        <div class="line"></div>
        <h2 class="title-sections">Tenis de mujer</h2>
        <div class="container-cards">
            <?php 
          
                $result_products_woman = products_woman("global/connection.php", 4);

                while($row = mysqli_fetch_array($result_products_woman)){
                    if($row['promo']){
                        $price = $row['precio_promo'];
                    }else{
                        $price = $row['precio'];
                    }
          ?>
            <div class="card">
                <div class="card-img">
                    <img src="uploaded_images/<?php echo $row['imagen']?>" alt="" class="rotate" />
                </div>
                <div class="card-text">
                    <h2><?php echo $row['nombre']?></h2>
                    <p>$<?php echo $price?></p>
                    <form class="add" method="GET" action="product.php">
                        <!-- 
                            En esta ocacion quise pasar todos los datos de una en vez de solo el id del producto, para evitar hacer otra consulta a la base de datos 
                        -->
                        <input type="hidden" name="id_product" value="<?php echo $row['id_producto'];?>">
                        <input type="hidden" name="qty_product" value="<?php echo 1?>" />

                        <button type="submit">
                            Ver producto
                            <i class='bx bx-right-arrow-alt'>
                            </i>
                        </button>

                    </form>
                </div>
            </div>
            <?php }?>

        </div>

        <section class="discount">
            <div>
                <p class="text-off">50% OFF!</p>
                <p class="text-description">In adidas Superstar Sneakers</p>
                <button type="button" class="button-black">Shop now</button>
            </div>
            <div>
                <img src="assets/img/offert.png" alt="">
            </div>
        </section>
    </section>
    <section id="new-collection" class="new-collection">
        <div class="line"></div>
        <h2 class="title-sections">Nueva colección</h2>
        <div class="container-cards grid">
            <div class="card">
                <div class="card-img">
                    <img src="assets/img/imghome.png" alt="" />
                </div>
                <div class="text-card">
                    <p class="men-shoes">Mens shoes</p>
                    <p class="price">From $79.99</p>
                    <div class="add">
                        <p class="view">ver coleccion</p>
                        <i class='bx bx-right-arrow-alt'></i>
                    </div>

                </div>

            </div>

            <?php 

              $result = order_random("global/connection.php", 3);
              while($row = mysqli_fetch_array($result)){
                ?>
            <div class="card-hover card">
                <img src="uploaded_images/<?php echo $row['imagen'] ?>" alt="" />
                <div class="card-hover-active">
                    <form action="actions/actions.php" method="POST">
                        <input type="hidden" name="id_product"
                            value="<?php echo openssl_encrypt($row['id_producto'], COD, KEY)?>">
                        <input type="hidden" name="name_product"
                            value="<?php echo openssl_encrypt($row['nombre'], COD, KEY)?>">
                        <input type="hidden" name="img_product"
                            value="<?php echo openssl_encrypt($row['imagen'], COD, KEY)?>">
                        <input type="hidden" name="description_product"
                            value="<?php echo openssl_encrypt($row['descripcion'], COD, KEY)?>">
                        <input type="hidden" name="price_product"
                            value="<?php echo openssl_encrypt($price, COD, KEY)?>">
                        <input type="hidden" name="gender_product"
                            value="<?php echo openssl_encrypt($row['genero'], COD, KEY)?>">
                        <input type="hidden" name="cantidad_product" id="result" value="<?php echo 1?>">
                        <input type="hidden" name="size"
                            value="<?php echo openssl_encrypt(25, COD, KEY)?>">
                        <button type="submit" class="button-black" name="add_cart">Agregar al carrito</button>
                    </form>
                </div>
            </div>
            <?php }?>
        </div>

        <section class="subscribe">
            <p class="text-subscribe">subscribe And Get 10% OFF</p>
            <p class="text-discount">Get 10% discount for all products</p>
            <div class="inputs">
                <input type="text" value="" placeholder="@email.com" />
                <button class="button-black">Subscribe</button>
            </div>

        </section>
    </section>
</main>
<?php include("include/template/footer.php")?>