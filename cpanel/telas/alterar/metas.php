<?php
$tabela = "tipo_metas";
if (isset($_POST)) {
    if ($_POST != null) {

        obrigatorio("Meta", addslashes($_POST["meta"]), "text");
        obrigatorio("Texto", addslashes($_POST["obs"]), "text");

        global $obrigatorio;
        if (empty($obrigatorio)) {
            $id = $_POST["id"];
            $id_meta = $_POST["id_meta"];
            $meta = addslashes($_POST["meta"]);
            $texto = $_POST["obs"];
            if (verificaAlterar($tabela, "nome", $_POST["meta"], $id)) {
                $pdo = Conexao::getInstance();
                try {
                    $update = $pdo->prepare("UPDATE " . $tabela . " SET nome='" . $meta . "' WHERE id=" . $id);
                    $update->execute();

                    if ($update->rowCount() == 1) {
                        $pdo2 = Conexao::getInstance();
                        try {
                            $update2 = $pdo2->prepare("UPDATE metas SET texto='" . $texto ."' WHERE id='" . $id_meta."'");
                            $update2->execute();

                        } catch (PDOException $e) {
                            echo "Erro: " . $e->getMessage();
                        }
                    }
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
            } else {
                $erro = "Já existe uma Meta como o Nome: " . $_POST["meta"];
            }

        } else {
            $erro = $obrigatorio;
        }
    }
}

$dados = listarId($tabela, $_GET["id"]);
?>
<div class="panel panel-warning">
    <div class="panel-heading text-center">:.EDITANDO METAS.:</div>
    <div class="panel-body">
        <form name="cadastrar" class="form-horizontal" action="" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

            <div class="form-group">
                <label for="nome" class="col-sm-2 control-label">Meta: </label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="meta" name="meta"
                           placeholder="Entre com a meta" value="<?php if (!empty($_POST['meta'])) {
                        echo $_POST['meta'];
                    } else {
                        echo $dados["nome"];
                    } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="observacao" class="col-sm-2 control-label">Texto: </label>

                <div class="col-sm-10">
                    <input type="hidden" name="id_meta"
                           value="<?php echo listarMetas("metas", $dados["id"])["texto"]; ?>">
                    <textarea name="obs" class="form-control" rows="3"><?php if (!empty($_POST['obs'])) {
                            echo $_POST['obs'];
                        } else {
                            echo listarMetas("metas", $dados["id"])["texto"];
                        } ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 text-right">
                    <button type="submit" class="btn btn-warning active">Alterar</button>
                </div>
            </div>
        </form>
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