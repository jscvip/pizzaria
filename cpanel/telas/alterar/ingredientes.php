<?php
$tabela = "ingredientes";
if (isset($_POST)) {
    if ($_POST != null) {
        obrigatorio("Nome do Ingrediente", addslashes($_POST["nome"]), "text");
        global $obrigatorio;
        if (empty($obrigatorio)) {
            $id = $_POST["id"];
            $nome = addslashes($_POST["nome"]);
            $valor = $_POST["valor"];
            if (verificaAlterar($tabela, "nome", $_POST["nome"], $id)) {

                $pdo = Conexao::getInstance();
                try {

                    $update = $pdo->prepare("UPDATE " . $tabela . " SET nome='" . $nome . "', valor='" . $valor . "' WHERE id=" . $id);
                    $update->execute();

                    if ($update->rowCount() == 1) {
                        $sucesso = $tabela . " atualizado com sucesso!";
                    } else {
                        $erro = "Não foi possível atualizar " . $tabela . "!";
                    }
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
            } else {
                $erro = "Esse ingrediente já está gravado no banco de dados!";
            }

        } else {
            $erro = $obrigatorio;
        }
    }
}

$dados = listarId($tabela, $_GET["id"]);
?>
<div class="panel panel-warning">
    <div class="panel-heading text-center">:.ALTERANDO INGREDIENTE.:</div>
    <div class="panel-body">
        <form name="alterar" class="form-horizontal" action="" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

            <div class="form-group">
                <label for="nome" class="col-sm-4 control-label">Ingrediente: </label>

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

                <div class="col-sm-2">
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