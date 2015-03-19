<?php
if (isset($_POST)) {
    if ($_POST != null) {
        if (isset($_POST["escolher"])) {
            unset($_SESSION["buscaPizza"]);
        } else {

            if (isset($_POST["ingrediente"])) {
                obrigatorio("Ingrediente", $_POST["ingrediente"], "select");
                global $obrigatorio;
                if (empty($obrigatorio)) {
                    $pdo = Conexao::getInstance();
                    $verificaCadastro = $pdo->prepare("SELECT * FROM itens_pizza WHERE id_pizza = '" . $_POST["idpizza"] . "' AND id_ingredientes = '" . $_POST["ingrediente"] . "'");
                    $verificaCadastro->execute();

                    if ($verificaCadastro->rowCount() == 1) {
                        $erro = "Já Existe esse ingrediente nessa pizza!";
                    } else {

                        try {
                            //echo "INSERT INTO " . $table . "(" . $buildFields . ") VALUES (" . $buildValues . ")<br>";
                            $prepareInsert = $pdo->prepare("INSERT INTO itens_pizza(id_pizza, id_ingredientes) VALUES (" . $_POST['idpizza'] . "," . $_POST['ingrediente'] . ")");
                            $prepareInsert->execute();
                            if ($prepareInsert->rowCount() > 0) {
                                $sucesso = "Ingrediente cadastrado com sucesso!";
                            } else {
                                $erro = "Não foi possivel gravar ingrediente";
                            }
                        } catch (PDOException $e) {
                            echo "Erro ao cadastrar " . $e->getMessage();
                        }
                    }

                } else {
                    $erro = $obrigatorio;
                }
            }
        }

        if(isset($_POST["del_ingr"])){
            if (isset($_POST["id_pizza"])) {
                $idp = $_POST["id_pizza"];
                $idi = $_POST["id_ingrediente"];

                $pdo = Conexao::getInstance();
                try {
                    $deletar = $pdo->prepare("DELETE FROM itens_pizza WHERE id_pizza=" . $idp . " AND id_ingredientes=" . $idi);
                    $deletar->execute();


                    if ($deletar->rowCount() == 1) {
                        $sucesso = "ingrediente deletado com sucesso!";
                        ?>
                    <?php
                    } else {
                        $erro = "Não foi possível deletar ingrediente!"; ?>
                    <?php }
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
            }
        }
    }
}

//Pegando GETs
?>
<div class="panel panel-success">
    <div class="panel-heading text-center">:.MONTE A PIZZA.:</div>
    <div class="panel-body">
        <?php
        if (!isset($_SESSION["buscaPizza"]) && !isset($_POST["pizzaBusca"])) {
            ?>
            <form name="busca" class="form-inline" action="" method="post">
                <!-- Busca pizza -->
                <div class="form-group">
                    <div class="col-sm-3">
                        <select class="form-control" name="categ">
                            <option value="0">Selecione uma categoria</option>
                            <?php
                            foreach (listar("categorias") as $cat) {
                                ?>
                                <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["nome"]; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
                <div id="resposta" style="float: right;"></div>
                <!-- Fim Busca Pizza -->
            </form>

        <?php
        } else {
            if (isset($_POST["pizzaBusca"])) {
                $_SESSION["buscaPizza"] = $_POST["pizzaBusca"];
                obrigatorio("Pizza", $_SESSION["buscaPizza"], "select");
            }

            global $obrigatorio;
            if (empty($obrigatorio) || isset($_POST["ingrediente"])) {
                $id = $_SESSION["buscaPizza"];
                if (listarId("pizzas", $id)) {
                    $p = listarId("pizzas", $_SESSION["buscaPizza"]);
                    $c = listarId("categorias", $p["id_categoria"]);
                    ?>
                    <div class="col-sm-8">
                        Pizza <?php echo $c["nome"]; ?>
                        <br>Nome da Pizza: <?php echo $p["nome"]; ?>
                        <br>Valor: <?php echo $p["valor"]; ?>
                    </div>
                    <div class="img-thumbnail"><img src="../images/fotos/<?php echo $p['img_inicio']; ?>"></div>
                <?php
                }
                ?>
                <hr style="clear: both;">
                <p>Ingredientes:</p>

                <p style="font-family: arial, cursive">
                    <?php
                $dados = listarIngredientes("itens_pizza", $id);
                if ($dados) {
                    foreach ($dados as $i) {
                        $ingr = listarId("ingredientes", $i["id_ingredientes"]); ?>

                        <div
                            style="float: left; font-family: arial, cursive;margin: 2px; border: 1px solid #ce8483; padding: 2px; background-color: lavenderblush;display: inline-flex;">
                            <div style="float: left; padding-right: 2px;">
                                <?php echo $ingr["nome"]; ?>
                            </div>
                            <form action="" method="post" class="form-inline">
                                <input name="id_pizza" type="hidden" value="<?php echo $i["id_pizza"]; ?>">
                                <input name="id_ingrediente" type="hidden" value="<?php echo $ingr["id"]; ?>">
                                <button name="del_ingr" type="submit" style="font-size: 9px; float: right; border: 0; padding: 0; margin-top: 5px; color: red; background-color: lavenderblush;"><i
                                        class="glyphicon glyphicon-remove"></i></button>
                            </form>
                        </div>

                    <?php }
                } else {
                    echo "Não tem nenhum ingrediente adicionado!";
                } ?>
                </p>
                <hr style="clear: both;">
                <form name="cadastrar" class="form-inline" action="" method="post">
                    <div class="form-group" style="width: 330px;">
                        <label for="ingrediente" class="col-sm-3 control-label">Ingrediente: </label>
                        <input name="idpizza" type="hidden" value="<?php echo $id; ?>">

                        <div class="col-sm-6">
                            <select class="form-control" name="ingrediente">
                                <option value="0">Selecione um ingrediente</option>
                                <?php
                foreach (listar("ingredientes") as $ing) {
                    ?>
                    <option value="<?php echo $ing["id"]; ?>"><?php echo $ing["nome"]; ?></option>
                <?php }
                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success active">Add</button>
                    </div>
                    <div class="form-group" style="float: right;">
                        <button type="submit" id="escolher" name="escolher" class="btn btn-info active">Pronta</button>
                    </div>
                </form>
            <?php } else {
                $erro = $obrigatorio; ?>
                <form name="busca" class="form-inline" action="" method="post">
                    <!-- Busca pizza -->
                    <div class="form-group">
                        <div class="col-sm-3">
                            <select class="form-control" name="categ">
                                <option value="0">Selecione uma categoria</option>
                                <?php
                                foreach (listar("categorias") as $cat) {
                                    ?>
                                    <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["nome"]; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div id="resposta" style="float: right;"></div>
                    <!-- Fim Busca Pizza -->
                </form>
            <?php
            }
        } ?>
    </div>
    <?php
    if (isset($sucesso)) {
        if (!empty($sucesso)) {
            ?>
            <div class="alert alert-success" role="alert"
                 style="margin: 0; padding: 5px;"><?php echo $sucesso; ?></div>
        <?php }
    }
    if (isset($erro)) {
        if (!empty($erro)) {
            ?>
            <div class="alert alert-danger" role="alert" style="margin: 0; padding: 5px;"><?php echo $erro; ?></div>
        <?php }
    } ?>
</div>