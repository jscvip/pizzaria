<div class="row">
    <div class="col-md-5" >
        <?php $dados = listar("pizzas","status=1");
        foreach($dados as $d){
        ?>
        <div id='coin-slider' style="width: 300px; height: 300px;">
            <a href="/<?php echo $d["id"];?>" target="_blank">
                <img src='images/detalhes/<?php echo $d["img_detalhes"]; ?>'>
            </a>
        </div>
        <?php }?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#coin-slider').coinslider({
                    //width: 565, // width of slider panel
                    //height: 290, // height of slider panel
                    //spw: 7, // squares per width
                    //sph: 5, // squares per height
                    delay: 3000, // delay between images in ms
                    //sDelay: 30, // delay beetwen squares in ms
                    //opacity: 0.7, // opacity of title and navigation
                    titleSpeed: 500, // speed of title appereance in ms
                    effect: 'rain', // random, swirl, rain, straight
                    navigation: true, // prev next and buttons
                    links : false, // show images as links
                    hoverPause: true // pause on hover
                });
            });
        </script>
    </div>
    <div class="col-md-7">
        <?php
        if (isset($_GET["p"])) {
            try {
                carregaUrls($_GET["p"]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            include_once('views/home.php');
        } ?>
    </div>
</div>