
<div class="row" style="margin-top: 20px;">
    <div class="col-lg-3 menu">
        <?php include_once("menu.php");?>
    </div>
    <div class="col-lg-9">
        <?php
        if(isset($_GET["p"])) {
            try {
                carregaUrls($_GET["p"]);
            }catch (Exception $e){
                echo $e->getMessage();
            }
        }else{
            include_once('telas/dashboard.php');
        }?>
    </div>
</div>