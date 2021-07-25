<?php 
session_start();
    if(!isset($_SESSION['id_venta'])){
        header("location: index.php");
    }
    include("global/connection.php");
    $query = "SELECT ventas.* , 
               cliente.nombre,cliente.apellidos, cliente.email, cliente.telefono
               FROM ventas INNER JOIN cliente ON ventas.id_cliente = cliente.id_cliente 
               WHERE ventas.id_venta=".$_SESSION['id_venta']."";
               $result = mysqli_query($conn, $query);

    $data_user = mysqli_fetch_array($result);  
    // echo $_SESSION['id_cliente'] ;
    include("include/template/header.php");
?>
<script
    src="https://www.paypal.com/sdk/js?client-id=Af4P0MnhNpr5NdhBlGIa6pnupRGvGE53beX4ND93_dM8YBikiwYWfZhR3npZDdbHr7e5JX4ycrFvJBur&currency=MXN">
// Replace YOUR_CLIENT_ID with your sandbox client ID
</script>
<main class="pagar">
    <section class="payment_method">
        <h3>Metodo de pago</h3>
        <div id="paypal-button-container"></div>
    </section>
    <section class="details-order pagar">
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
    </section>
</main>

<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '<?php echo $total?>'
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            console.log(details);
            if(details.status == "COMPLETED"){
                 let data = new FormData();
                 data.append("payment_completed", true);
                 data.append("data", JSON.stringify(details));
                 data.append("method", "paypal");

                console.log(details);
                 fetch("actions/actions.php", {
                    method: "POST",
                    body:  data

                })
                .then((res) => res.json())
                .then((datos) => {
                    if(datos.success){
                        window.location="thankyou.php";
                    }
                });
            }
        });
    }
}).render('#paypal-button-container'); // Display payment options on your web page
</script>
<?php 
    include("include/template/footer.php");
?>