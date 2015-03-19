<?php
session_start();

include_once('../functions/config.php');
if (!$_SESSION['logado']) {
    header("Location:login.php");
}

try {
    carregaIncludes(array("login", "url", "cadastrar", "utils","conf_delete"));
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Pizaria da Net <?php if (isset($titulo)) {
            echo ' | ' . $titulo;
        } ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>public/css/bootstrap.css ">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>public/css/bootstrap-theme.css ">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>public/css/bootstrap.min.css ">
    <!-- Optional theme -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>public/css/bootstrap-theme.min.css ">

    <!-- Latest compiled and minified JavaScript -->
    <script src="<?php echo $base_url; ?>public/js/bootstrap.min.js "></script>

    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/jquery.js "></script>

    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/bootstrap.js "></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/npms/affix.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/npms/alert.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/npms/button.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/npms/carousel.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/npms/collapse.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/npms/dropdown.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/npms/modal.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/npms/popover.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/npms/scrollspy.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/npms/tab.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/npms/tooltip.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>public/js/npms/transition.js"></script>

    <script type="text/javascript" src="<?php echo $base_url; ?>cpanel/public/js/maskedinput.min.js"></script>

    <script type="text/javascript" src="<?php echo $base_url; ?>cpanel/public/js/metas.js"></script>

    <script type="text/javascript" src="<?php echo $base_url; ?>cpanel/public/js/tinymce/tinymce.min.js"></script>

    <script type="text/javascript" src="<?php echo $base_url; ?>cpanel/public/js/jquery.maskMoney.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>cpanel/public/css/template.css ">
</head>
<body>
<script type="text/javascript">
    $(function () {
        $('#valor').maskMoney({
                allowNegative: true,
                thousands: ',',
                decimal: '.',
                affixesStay: false
            }
        );
    })

    jQuery(function ($) {
        $("#fone").mask("(99) 9999-9999");
        $("#cel").mask("(99) 9999-9999");
        $("#cep").mask("99999-999");
    });
</script>

<div class="container-fluid" style="padding: 0;max-width: 800px;">
    <div class="row cabecalho">
        <img class="logo" src="../images/logo.png" width="30%">

        <div class="busca" style="" style="padding: 0; display: block;">
            <form class="form-inline" action="" method="post">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" name="busca" id="busca" placeholder="Busca">
                        <span class="input-group-btn">
                                <button type="submit" class="btn btn-circle">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                    </div>
                </div>
            </form>
        </div>
    </div>