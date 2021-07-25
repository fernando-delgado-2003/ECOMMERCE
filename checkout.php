<?php 
session_start();
if(isset($_SESSION['id_venta'])){
    header("location: pagar.php");
}
if(!isset($_SESSION['cart'])){
    header("location: index.php");
}
    include("include/template/header.php");
?>

<section class="message-feedback" id="message-feedback">
    <ul class="list">

    </ul>
</section>
<form class="form-check" id="form-check" action="actions/insert_order.php" method="POST">
    <div class="details-check details">
        <h3>Detalles de facturación</h3>
        <div class="container-inputs">
            <div class="item">
                <label for="name">Nobre<span>*</span></label>
                <input type="text" name="name" id="name" value="<?php echo data_client('name')?>" data-name="nombre">
            </div>
            <div class="item">
                <label for="last_name">Apellidos<span>*</span></label>
                <input type="text" name="last_name" id="last_name" value="<?php echo data_client('last_name')?>" data-name="apellidos">
            </div>
            <div class="item">
                <label>País / Región</label>
                <strong>México</strong>
            </div>
            <div class="item">
                <label for="address">Dirección de la calle <span>*</span></label>
                <input type="text" name="address_1 " id="address"
                    placeholder="Número interior o exterior y nombre de la calle" data-name="dirección">
                <input type="text" name="address_2" data-optional="true"
                    placeholder="Colonia, Apartamento, habitación, etc. (opcional)" id="address_2">
            </div>
            <div class="item">
                <label for="city">Localidad / Ciudad <span>*</span></label>
                <input type="text" name="city" id="city" data-name="localidad / ciudad">
            </div>
            <div class="item">
                <label for="state">Región / Estado <span>*</span></label>
                <input type="text" name="state" id="state" data-name="region / estado">
            </div>
            <div class="item">
                <label for="postcode">Codigo postal <span>*</span></label>
                <input type="text" name="postcode" id="postcode" data-name="codigo postal">
            </div>
            <div class="item">
                <label for="phone">Numero de telefono <span>*</span></label>
                <input type="tel" name="phone" id="phone" value="<?php echo data_client('phone')?>" data-name="telefono">
            </div>
            <div class="item">
                <label for="email">Correo electronico <span>*</span></label>
                <input type="email" name="email" id="email" value="<?php echo data_client('email')?>" data-name="correo">
            </div>
            <?php if(!isset($_SESSION['login'])){?>
            <div class="item" id="container-check">
                <div >
                    <label for="create_account ">¿Quieres crear una cuenta?</label>
                    <input type="checkbox" name="create_account" id="create_account" placeholder="Contraseña" data-optional="true">
                    <p>
                        Si no crea una cuenta se guardara su nombre y correo para hacer un seguimiento del pedido
                    </p>
                </div>
                <div>
                    <label for="password">Contraseña para la cuenta <span>*</span></label>
                    <input type="password" name="password" id="password" data-optional="true">
                </div>
            </div>
            <?php }?>
            <div class="more-inf">
                <h3>Información adicional</h3>
                <label for="more_inf">Referencia de la derección (opcional)</label>
                <textarea name="more_inf" id="more_inf" data-optional="true"
                    placeholder="Detalles adicionales del pedido, referencias de la dirección, etc"></textarea>
            </div>
        </div>
    </div>
    <div class="details-order details">
        <h3>Tu pedido</h3>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
            $total = 0;
            foreach($_SESSION['cart'] as $i => $product){
            $sub_total = $product['qty_product'] * $product['price_product'];
            $total = $total + $sub_total;
        ?>
                <tr>
                    <td><?php echo $product['name_product']?> <strong>× <?php echo $product['qty_product']?></strong>
                    </td>
                    <td>
                        $<?php echo $product['price_product'] ?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <td><strong>$<?php echo $total;?></strong></td>
                </tr>
            </tfoot>
        </table>
        <div class="method-buy">
            <!-- <div>
                <div class="container-checkbox">
                    <input type="checkbox" name="method_paypal" id="method_paypal" class="method-check">
                    <img src="assets/img/logo_paypal.png" alt="">
                </div>
                <div class="collapse-paypal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="163" height="80.9" viewBox="-252.3 356.1 163 80.9"
                        enable-background="new -252.3 356.1 163 80.9">
                        <path stroke="#B2B2B2" stroke-width="2" stroke-miterlimit="10"
                            d="M-108.9 404.1v30c0 1.1-.9 2-2 2h-120.1c-1.1 0-2-.9-2-2v-75c0-1.1.9-2 2-2h120.1c1.1 0 2 .9 2 2v37m-124.1-29h124.1"
                            fill="none" />
                        <circle fill="#B2B2B2" cx="-227.8" cy="361.9" r="1.8" />
                        <circle fill="#B2B2B2" cx="-222.2" cy="361.9" r="1.8" />
                        <circle fill="#B2B2B2" cx="-216.6" cy="361.9" r="1.8" />
                        <path stroke="#B2B2B2" stroke-width="2" stroke-miterlimit="10"
                            d="M-128.7 400.1h36.7m-3.6-4.1l4 4.1-4 4.1" fill="none" />
                    </svg>
                    se abrira una nueva pestaña -->
                    <!-- <p>Luego de hacer clic en “Realizar pago”, serás redirigido a PayPal para completar tu compra de
                        forma segura.</p>

                </div>
            </div> -->
            <!-- <div class="collapse-merdadopago">
            </div>
            <div class="collapse-divisa">
            </div> -->
            <input type="hidden" name="pay">
            <input type="submit" value="Realizar pago" id="paymed">
        </div>
    </div>
</form>

<!-- <script>
paypal.Buttons({
    style: {
        layout: 'horizontal'
    },
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '0.01'
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            console.log(details);
            alert('Transaction completed by ' + details.payer.name.given_name);
        });
    }
}).render('#paypal-button-container'); // Display payment options on your web page
</script> -->
<?php 
    include("include/template/footer.php");
?>

<?php 

      function data_client($index){
        if(isset($_SESSION['data_cliente'])){
            if(isset($_SESSION['data_cliente'][$index])){
                return $_SESSION['data_cliente'][$index];
            }else{
                return "";
            }
        }else{
            return "";
        }
      }

?>