<?php 
session_start();
if(!isset($_SESSION['id_venta'])){
    header("location: index.php");
}
    include("include/template/header.php");

    $data = $_SESSION['data_payment'];
    if(isset($_SESSION['id_venta']) && isset($_SESSION['data_payment'])){
        unset($_SESSION['id_venta']);
        unset($_SESSION['data_payment']);
    }
?>
<main class="thankyou">
    <div class="info">
        <div class="container-icon-check" id="container-icon-check">
            <div class="icon-check" id="icon-check">
            </div>

        </div>
        <p>¡Listo, muchas gracias por su compra!</p>
            <p class="amount">monto pagado: $<?php echo $data['purchase_units'][0]['amount']['value']?> <?php echo $data['purchase_units'][0]['amount']['currency_code']?></p>
            <a href="index.php">Ir ala pagina de inicio</a>
    </div>
</main>

<?php
    include("include/template/footer.php");
?>