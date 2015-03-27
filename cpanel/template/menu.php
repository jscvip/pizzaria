<?php
$cadastrar = "";
$listar = "";
$relatorio = "";
$montar = "";
if (isset($_GET["p"])) {
    $tipo = explode("_", $_GET["p"]);
    switch ($tipo[0]) {
        case "cadastrar":
            if ($tipo[1] == "montar-pizza") {
                $montar = "in";
            } else {
                $cadastrar = "in";
            }
            break;
        case "listar":
            $listar = "in";
            break;
        case "relatorio":
            $relatorio = "in";
            break;
    }
}
?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                   aria-controls="collapseOne">
                    Cadastros
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse <?php echo $cadastrar; ?>" role="tabpanel"
             aria-labelledby="headingOne">
            <div class="panel-body">
                <ul>
                    <?php if (cadastrar("clientes")) { ?>
                        <li><a href="?p=cadastrar_clientes">Cadastrar Clientes</a></li><?php } ?>
                    <?php if (cadastrar("tipo-metas")) { ?>
                        <li><a href="?p=cadastrar_tipo-metas">Cadastrar Tipo Metas</a></li><?php } ?>
                    <?php if (cadastrar("metas")) { ?>
                        <li><a href="?p=cadastrar_metas">Cadastrar Metas</a></li><?php } ?>
                    <?php if (cadastrar("ingredientes")) { ?>
                        <li><a href="?p=cadastrar_ingredientes">Cadastrar Ingredientes</a></li><?php } ?>
                    <?php if (cadastrar("pizzas")) { ?>
                        <li><a href="?p=cadastrar_pizzas">Cadastrar Pizzas</a></li><?php } ?>
                    <?php if (cadastrar("categorias")) { ?>
                        <li><a href="?p=cadastrar_categorias">Cadastrar Categorias</a></li><?php } ?>
                    <?php if (cadastrar("administradores")) { ?>
                        <li><a href="?p=cadastrar_administradores">Cadastrar Administradores</a></li><?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                    Montar
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse <?php echo $montar; ?>" role="tabpanel"
             aria-labelledby="headingTwo" arial-expanded="true">
            <div class="panel-body">
                <ul>
                    <li><a href="?p=cadastrar_montar-pizza">Montar Pizza</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                   aria-expanded="false" aria-controls="collapseThree">
                    Listar
                </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse <?php echo $listar; ?>" role="tabpanel"
             aria-labelledby="headingThree">
            <div class="panel-body">
                <ul>
                    <?php if (alterar("clientes")) { ?>
                        <li><a href="?p=listar_clientes">listar Clientes</a></li><?php } ?>
                    <?php if (alterar("metas")) { ?>
                        <li><a href="?p=listar_metas">listar Metas</a></li><?php } ?>
                    <?php if (alterar("ingredientes")) { ?>
                        <li><a href="?p=listar_ingredientes">listar Ingredientes</a></li><?php } ?>
                    <?php if (alterar("categorias")) { ?>
                        <li><a href="?p=listar_categorias">listar Categorias</a></li><?php } ?>
                    <?php if (alterar("pizzas")) { ?>
                        <li><a href="?p=listar_pizzas">listar Pizzas</a></li><?php } ?>
                    <?php if (alterar("administradores")) { ?>
                        <li><a href="?p=listar_administradores">listar Administradores</a></li><?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingFive">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
                   aria-expanded="false" aria-controls="collapseFive">
                    Relatórios
                </a>
            </h4>
        </div>
        <div id="collapseFive" class="panel-collapse collapse <?php echo $relatorio; ?>" role="tabpanel"
             aria-labelledby="headingFive">
            <div class="panel-body">
                <ul>
                    <li><a href="">Relatórios dos Pedidos</a></li>
                    <li><a href="">Relatório dos Clientes</a></li>
                    <li><a href="">Emails recebidos</a></li>
                    <li><a href="">Aniversariantes</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="?acao=logout">
                    LOGOUT
                </a>
            </h4>
        </div>
    </div>
</div>
