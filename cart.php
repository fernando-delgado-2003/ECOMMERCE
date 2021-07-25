<?php 
    include("include/template/header.php");
?>
<?php 
    // if(!isset($_SESSION['login'])){
    //     header("location: login.php");
    // }

    if(isset($_SESSION['message'])){?>
<div class="message">
    <?php echo $_SESSION['message']?>
</div>
<?php } unset($_SESSION['message']); ?>

<table cellpadding="0" cellspacing="0" id="table-cart">
    <thead>
        <tr>
            <th>nombre</th>
            <th>foto</th>
            <th>cantidad</th>
            <th>genero</th>
            <th>precio</th>
            <th>talla</th>
            <th>acciones</th>

        </tr>
    </thead>
    <tbody>
        <?php 
        $total = 0;
            include("global/connection.php");
            include("global/config.php");
            
            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
            foreach($_SESSION['cart'] as $i => $product) {
                $total = $total + ($product['qty_product'] * $product['price_product']);
        ?>
        <tr>

            <td width="20%" class="text-center"><?php echo $product['name_product'];?></td>

            <td width="15%" class="text-center"><img src="uploaded_images/<?php echo $product['img_product'];;?>" alt=""
                    width="50"></td>

            <td width="20%" class="text-center">
                <form class="count">
                    <button type="submit" name="plus" class="plus" value="<?php echo $product['id_product'];?>">
                        <i class='bx bx-plus'></i>
                    </button>

                    <input type="text" name="qty" class="result" id="result"
                        value="<?php echo $product['qty_product'];?>">

                    <button type="submit" name="minus" class="minus" value="<?php echo $product['id_product'];?>">
                        <i class='bx bx-minus'></i>
                    </button>
                </form>
            </td>

            <td width="20%" class="text-center"><?php echo $product['gender_product'];?></td>
            <td width="20%" class="text-center">$ <?php echo $product['price_product'];?></td>
            <td width="20%" class="text-center"><?php echo $product['size'];?></td>

            <td width="5%" class="text-center">
                <form action="actions/actions.php" method="POST">
                    <button class="btn-delete" type="submit" name="delete" value="<?php echo $product['id_product']?>">
                        <i class='bx bx-trash'></i>
                    </button>
                </form>
            </td>
        </tr>
        <?php } } ?>

    </tbody>
</table>
<?php if(isset($_SESSION['cart'])){?>
    <div class="totals-products">
            <h2>Total del carrito</h2>
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td>
                        Total
                        </td>
                        <td id="total">
                        $ <?php echo number_format($total, 2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">    
                        <?php if(!isset($_SESSION['id_venta'])){?>
                                <a href="checkout.php">Proceder a pagar</a>
                            <?php }else{?>
                                <a href="pagar.php">Seguir con el pago</a>
                                <!-- <a href="cancel_pay.php">Cancelar pago</a> -->
                            <?php }?>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
    <?php }?>
<?php 
    include("include/template/footer.php");
?>