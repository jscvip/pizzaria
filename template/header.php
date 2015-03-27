<?php
include_once('functions/config.php');
include_once('cpanel/functions/utils.php');

if($d=listar("tipo_metas")){
    foreach($d as $dados){
        $k=listarMetas("metas",$dados["id"]);
        $$dados["nome"]=$k["texto"];
    }
}

try {
    carregaIncludes(array("url"));
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta property="og:url" content="<?php if(isset($url)){ echo $url;}else{echo $base_url;}?>">

    <meta property="og:title" content="<?php if(isset($titulo)){echo $titulo;}else{if(isset($title)){echo $title;}}?>">
    <meta property="og:site_name" content="<?php if(isset($site)){echo $site;}else{if(isset($site_name)){echo $site_name;}}?>">

    <meta property="og:description" content="<?php if(isset($descricao)){echo $descricao;}else{if(isset($description)){echo $description;}};?>">

    <meta property="og:image" content="<?php if(isset($imagem)){echo $imagem;}else{}?>">

    <meta property="og:type" content="website">

    <meta name="keywords" content="<?php if(isset($keywords2)){echo $keywords2;}else{if(isset($keywords)){echo $keywords;}}?>"/>

    <title><?php if(isset($site_name)){echo $site_name;} if (isset($titulo)){ echo " - ".$titulo;}else{if(isset($title)){echo " - ".$title;}} ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>public/css/bootstrap.css ">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>public/css/bootstrap-theme.css ">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo $base_url;?>public/css/bootstrap.min.css ">
    <!-- Optional theme -->
    <link rel="stylesheet" href="<?php echo $base_url;?>public/css/bootstrap-theme.min.css ">

    <!-- Latest compiled and minified JavaScript -->
    <script src="<?php echo $base_url;?>public/js/bootstrap.min.js "></script>

    <script type="text/javascript" src="<?php echo $base_url;?>public/js/jquery.js "></script>

    <script type="text/javascript" src="<?php echo $base_url;?>public/js/bootstrap.js "></script>
    <script type="text/javascript" src="<?php echo $base_url;?>public/js/npms/affix.js"></script>
    <script type="text/javascript" src="<?php echo $base_url;?>public/js/npms/alert.js"></script>
    <script type="text/javascript" src="<?php echo $base_url;?>public/js/npms/button.js"></script>
    <script type="text/javascript" src="<?php echo $base_url;?>public/js/npms/carousel.js"></script>
    <script type="text/javascript" src="<?php echo $base_url;?>public/js/npms/collapse.js"></script>
    <script type="text/javascript" src="<?php echo $base_url;?>public/js/npms/dropdown.js"></script>
    <script type="text/javascript" src="<?php echo $base_url;?>public/js/npms/modal.js"></script>
    <script type="text/javascript" src="<?php echo $base_url;?>public/js/npms/popover.js"></script>
    <script type="text/javascript" src="<?php echo $base_url;?>public/js/npms/scrollspy.js"></script>
    <script type="text/javascript" src="<?php echo $base_url;?>public/js/npms/tab.js"></script>
    <script type="text/javascript" src="<?php echo $base_url;?>public/js/npms/tooltip.js"></script>
    <script type="text/javascript" src="<?php echo $base_url;?>public/js/npms/transition.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>public/css/template.css ">

    <script src="<?php echo $base_url;?>biblioteca/coin-slider/coin-slider.js "></script>
    <script src="<?php echo $base_url;?>biblioteca/coin-slider/coin-slider.min.js "></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>biblioteca/coin-slider/coin-slider-styles.css ">
</head>
<body>
<div class="container-fluid" style="padding: 0; max-width: 800px;">
    <div class="row topo">
        <img class="logo" src="images/logo.png" width="30%">
        <div class="busca" style="width: 350px;">
            <form class="form-inline" action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control input-sm" name="busca" id="busca" placeholder="Busca" style="width: 150px; float: left;">
                </div>
                <div class="form-group">
                    <select id="selBusca" name="selBusca" class="form-control input-sm" style="width: 150px; float: left;">
                        <option>Selecione...</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-circle">OK</button>
            </form>
        </div>
    </div>