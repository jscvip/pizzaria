<?php
include_once('functions/config.php');
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta property="og:url" content="<?php //echo $url;?>">

    <meta property="og:title" content="<?php //echo $titulo3;?>">
    <meta property="og:site_name" content="Pizzaria da Net">

    <meta property="og:description" content="<?php //echo substr($descricao,0,199);?>">

    <meta property="og:image" content="<?php //echo $imagem;?>">

    <meta property="og:type" content="website">

    <meta name="keywords" content="<?php //echo $keywords2;?>"/>

    <title>Pizaria da Net <?php if (isset($titulo)) {
            echo ' | ' . $titulo;
        } ?></title>

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
        <div class="row">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"style="padding-left: 0px; padding-right: 0px;">
                        <ul class="nav navbar-nav" style="height: 36px;">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#">A empresa</a></li>
                            <li><a href="#">Meus pedidos</a></li>
                            <li><a href="#">Cadastro</a></li>
                            <li><a href="#">Contato</a></li>
                            <li><a href="#">Pizzas</a></li>
                            <li><a href="#">Login</a></li>
                        </ul>

                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
        <div class="row">
            <div class="col-md-4">.col-md-4</div>
            <div class="col-md-4">.col-md-4</div>
            <div class="col-md-4">.col-md-4</div>
        </div>
        <div class="row rodape">
            Pizzaria da Net <?php echo date("Y");?> - Todos os Direitos Reservados
        </div>
    </div>
</body>
</html>