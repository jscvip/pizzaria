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