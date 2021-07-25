<footer class="footer grid">
    <div class="roby">
        <h2>Roby</h2>
        <p>Nueva colección de zapatos 2021</p>
    </div>
    <div class="explore">
        <h2>Explore</h2>
        <a href="#home">Inicio</a>
        <a href="#featured">Oferta</a>
        <a href="#women">Mujer</a>
        <a href="#new-collection">Nuevos</a>
    </div>
    <div class="suport">
        <h2>Suport</h2>
        <a href="#">Ayuda con un producto </a>
        <a href="#">Atención al cliente </a>
        <a href="#">Servicios autorizados</a>
    </div>
    <div class="social">
        <a href="#"><i class='bx bxl-facebook'></i></a>
        <a href="#"><i class='bx bxl-instagram'></i></a>
        <a href="#"><i class='bx bxl-twitter'></i></a>
        <a href="#"><i class='bx bxl-google'></i></a>
    </div>
</footer>
<p class="credits">diseño de <a href="https://www.youtube.com/channel/UCgkDs77BoEhMIgRUB4MKrtQ"
        target="_blanck">Bendimcode</a>, yo solo la maquete.</p>
</div>
<?php 
    $page = get_page();
?>
    <script src="assets/js/index.js" type="text/javascript" charset="utf-8"></script>

<?php if($page === "search"){  ?>
    <script src="assets/js/search.js" type="text/javascript" charset="utf-8"></script>
<?php }?>
<?php if($page === "checkout"){ ?>
    <script src="assets/js/checkout.js" type="text/javascript" charset="utf-8"></script>
<?php } ?>
</body>

</html>