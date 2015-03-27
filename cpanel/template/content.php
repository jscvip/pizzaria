<div class="row" style="margin-top: 20px;">
    <div class="col-lg-3 menu">
        <?php include_once("menu.php"); ?>
    </div>
    <div class="bemvindo">

        Bem Vindo <?php echo $_SESSION["nome_admin"];?>,
        <?php
        $dataLogin =ultimoLogin($_SESSION["id_admin"]);
        if(empty($dataLogin)){
            echo " esse é seu primeiro Login";
        }else{
            echo " seu ultimo login foi em ".date("d/m/Y H:i:s",strtotime($dataLogin));
        }
        ?>
    </div>
    <div class="col-lg-9" id="carregar_busca">
        <?php
        //include_once("telas/buscar.php");
        if (isset($_GET["p"])) {
            $modo = explode("_", $_GET["p"]);
            switch ($modo[0]) {
                case "cadastrar":
                    $m = cadastrar($modo[1]);
                    break;
                case "listar":
                    $m = alterar($modo[1]);
                    break;
                case "alterar":
                    $m = alterar($modo[1]);
                    break;
                case "view":
                    $m = "view";
                    break;
                default : $m=""; break;
            }
            if ($m) {
                try {
                    carregaUrls($_GET["p"]);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                ?>
                <div class="alert alert-danger" role="alert" style="margin: 0; padding: 5px;">
                    Você não tem permissão para acessar essa área!<br>
                    Entre em contato com o administrador
                </div>
            <?php
            }

        } else {
            include_once('telas/dashboard.php');
        } ?>
    </div>
</div>