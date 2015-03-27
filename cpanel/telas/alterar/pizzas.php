<?php
require_once("biblioteca/wideimage/WideImage.php");
$tabela = "pizzas";
if (isset($_FILES)) {
    if ($_FILES != null) {
        obrigatorio("Imagem da Pizza", $_FILES["imagem"]["name"], "text");

        global $obrigatorio;

        if (empty($obrigatorio)) {
            $id = $_GET["id"];
            $foto_old = $_POST['imagem_old'];
            $foto = $_FILES['imagem']['name'];
            $ext = explode(".", $foto);
            $extf = end($ext);
            $img_type = $_FILES['imagem']['type'];

            if (preg_match("/(image)/", $img_type)) {
                $temp = $_FILES['imagem']['tmp_name'];
                $caminhoi = "../images/fotos/";
                $arquivoi = $caminhoi . $foto_old;
                $caminhod = "../images/detalhes/";
                $arquivod = $caminhod . $foto_old;

                if (file_exists($arquivoi)) {
                    if (file_exists($arquivod)) {
                        $nome_foto = tiraespecialeespaco($_POST["nome_pizza"]) . "." . $extf;
                        try{
                            if(unlink($arquivoi)){
                                if(unlink($arquivod)){
                                    try {
                                        $fotos = WideImage::load($temp);
                                        $redimensionar = $fotos->resize(105, 80, "fill");
                                        $redimensionar->saveToFile("../images/fotos/" . $nome_foto);

                                        if ($redimensionar->isValid()) {
                                            $redimensionar = $fotos->resize(300, 300, "fill");
                                            $redimensionar->saveToFile("../images/detalhes/" . $nome_foto);

                                            $pdo = Conexao::getInstance();
                                            try {
                                                $update = $pdo->prepare("UPDATE " . $tabela . " SET img_inicio='" . $nome_foto . "', img_detalhes='" . $nome_foto . "' WHERE id=" . $id);
                                                $update->execute();

                                                if ($update->rowCount() == 1) {
                                                    $sucesso = $tabela . " atualizado com sucesso!";
                                                    echo "<meta HTTP-EQUIV='refresh' CONTENT='5;URL='>";
                                                }
                                            } catch (PDOException $e) {
                                                $erro = $e->getMessage();
                                            }
                                        } else {
                                            throw new WideImage_Exception("Não foi possivel redimensionar imagem");
                                        }
                                    } catch (WideImage_Exception $e) {
                                        $erro = "Erro: " . $e->getMessage();
                                    }

                                }else{
                                    $erro = "Não foi possivel excluir a imagem detalhe!";
                                }
                            }else{
                                $erro = "Não foi possivel excluir a imagem inicial!";
                            }

                        }catch (Exception $e){
                            $erro = "Erro : ".$e->getMessage();
                        }

                    } else {
                        $error = "Imagem destaque " . $foto_old . ", não encontrada!";
                    }
                } else {
                    $error = "Imagem inicial " . $foto_old . ", não encontrada!";
                }
            } else {
                $erro = "Esse arquivo não é uma imagem válida!";
            }
        } else {
            $erro = $obrigatorio;
        }
    }
}
if (isset($_POST)) {
    if ($_POST != null) {
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

        if (isset($_POST["del_ingr"])) {
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

        if (isset($_POST["nome"])) {
            obrigatorio("Nome", $_POST["nome"], "text");
            obrigatorio("Valor", $_POST["valor"], "text");

            global $obrigatorio;

            if (empty($obrigatorio)) {
                $id = $_POST["id"];
                $nome=addslashes($_POST["nome"]);
                $valor=$_POST["valor"];
                if (verificaAlterar($tabela,"nome",$_POST["nome"],$id)) {
                    $pdo = Conexao::getInstance();
                    try {
                        $update = $pdo->prepare("UPDATE " . $tabela . " SET nome='" . $nome . "', valor='".$valor."' WHERE id=" . $id);
                        $update->execute();

                        if ($update->rowCount() == 1) {
                            $sucesso = $tabela." atualizado com sucesso!";
                        } else {
                            $erro = "Não foi possível atualizar ".$tabela."!";
                        }
                    } catch (PDOException $e) {
                        echo "Erro: " . $e->getMessage();
                    }
                }else{
                    $erro = "Essa pizza já está gravada no banco de dados!";
                }

            }else{
                $erro = $obrigatorio;
            }

        }
    }
}

$dados = listarId($tabela, $_GET["id"]);
?>
<div class="panel panel-warning">
    <div class="panel-heading text-center">:.ALTERANDO PIZZAS.:</div>
    <div class="panel-body">
        <div class="imagem col-sm-4">
            <img src="../images/fotos/<?php echo $dados["img_inicio"]; ?>" width="150">

            <form name="alt_imagem" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="imagem_old" name="imagem_old"
                       value="<?php echo $dados["img_inicio"]; ?>">
                <input type="hidden" class="form-control" id="nome_pizza" name="nome_pizza"
                       value="<?php echo $dados["nome"]; ?>">
                <input type="file" class="form-control" id="imagem" name="imagem">
                <button type="submit" class="btn btn-default active" style="width: 100%;">Alterar Imagem</button>
            </form>
        </div>
        <div class="pizza col-sm-8">
            <form name="alterar" class="form-horizontal" action="" method="post">
                <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

                <div class="form-group">
                    <label for="nome" class="col-sm-4 control-label">Pizza: </label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nome" name="nome"
                               value="<?php if (isset($_POST["nome"])) {
                                   echo $_POST["nome"];
                               } else {
                                   echo $dados["nome"];
                               } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="valor" class="col-sm-4 control-label">valor: </label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="valor" name="valor"
                               value="<?php if (isset($_POST["valor"])) {
                                   echo $_POST["valor"];
                               } else {
                                   echo $dados["valor"];
                               } ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="submit" class="btn btn-warning active">Alterar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="ingredientes col-sm-12">
            <hr style="clear: both;">
            <p>Ingredientes:</p>

            <p style="font-family: arial, cursive">
                <?php
                $dados2 = listarIngredientes("itens_pizza", $dados["id"]);
                if ($dados2) {
                foreach ($dados2 as $i) {
                $ingr = listarId("ingredientes", $i["id_ingredientes"]); ?>

            <div
                style="float: left; font-family: arial, cursive;margin: 2px; border: 1px solid #ce8483; padding: 2px; background-color: lavenderblush;display: inline-flex;">
                <div style="float: left; padding-right: 2px;">
                    <?php echo $ingr["nome"]; ?>
                </div>
                <form action="" method="post" class="form-inline">
                    <input name="id_pizza" type="hidden" value="<?php echo $i["id_pizza"]; ?>">
                    <input name="id_ingrediente" type="hidden" value="<?php echo $ingr["id"]; ?>">
                    <button name="del_ingr" type="submit"
                            style="font-size: 9px; float: right; border: 0; padding: 0; margin-top: 5px; color: red; background-color: lavenderblush;">
                        <i
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
                    <input name="idpizza" type="hidden" value="<?php echo $dados["id"]; ?>">

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
            </form>
        </div>
    </div>
    <?php if (isset($sucesso)) {
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