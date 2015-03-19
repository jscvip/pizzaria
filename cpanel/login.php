<?php
session_start();
include_once('../functions/config.php');
try{
    carregaIncludes(array("login"));
}catch (Exception $e){
    echo $e->getMessage();
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['logar'])){
        $usuario = addslashes($_POST["usuario"]);
        $senha = addslashes($_POST["senha"]);

        if(logar($usuario,$senha)){
            header("Location:index.php");
        }else{
           $erro = "Usuário ou senha inválidos!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
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

    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cpanel/public/css/template.css ">
</head>
<body>
    <div class="container-fluid" style="padding: 0; max-width: 800px;">
        <?php
        date_default_timezone_set('America/Sao_Paulo');
        $logo2=  'semlogo.jpg';

        if (file_exists('./imagens/logo.jpg')){
            $logo2 = 'logo.jpg';
        }
        if(file_exists('./imagens/logo.jpeg')){
            $logo2 = 'logo.jpeg';
        }
        if(file_exists('./imagens/logo.bmp')){
            $logo2 = 'logo.bmp';
        }
        ?>
        <div class="panel panel-primary" style="background: #CCCCCC; padding-bottom: 0px; margin-bottom: 0;">
            <div class="panel-heading" style="margin-bottom: 10px;">
                <span class=" h1" align="center">Administração - Login</span>
            </div>
            <div class="panel-body" id="form-login">
                <div class="col-sm-5" style="height: 230px;">
                    <img src="./imagens/<?php echo $logo2;?>" title="logo do site" />
                    <p style="position: absolute; bottom: 0;">
                        <?php echo date("d/m/Y")." ".date("H:i:s");?><br>
                        IP: <?php echo getenv("REMOTE_ADDR");?>
                    </p>
                </div>
                <div class="col-sm-7">
                    <form action="" method="post">
                    <p>
                        Entre com seu usuário e senha seus acessos estão sendo monitorados
                    </p>
                    <div class="form-group">
                        <label for="usuario" class="col-sm-4 control-label">Usuário:</label>
                        <div class="col-sm-8">
                            <input type="text" name="usuario">
                        </div>
                    </div>
                        <div style="clear: both; padding: 5px;"></div>
                    <div class="form-group">
                        <label for="senha" class="col-sm-4 control-label">Senha:</label>
                        <div class="col-sm-8">
                            <input type="password" name="senha">
                        </div>
                    </div>
                        <div style="clear: both; padding: 5px;"></div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="logar" value="submit" class="btn btn-success btn-lg btn-block active">
                                Entrar
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php if(isset($erro)){
            if(!empty($erro)){?>
            <div class="alert alert-danger" role="alert" style="margin: 0; padding: 5px;"><?php echo $erro;?></div>
        <?php }}?>
    </div>
</body>
</html>