<?php
$tabela = "clientes";
if (isset($_POST)) {
    if ($_POST != null) {
        obrigatorio("Senha", addslashes($_POST["senha"]),"text");
        global $obrigatorio;
        if (empty($obrigatorio)) {
            $id=$_POST["id"];
            $senha_old=$_POST["senha_old"];
            $senha=addslashes(md5($_POST["senha"]));
            if ($senha != $senha_old) {

                    $pdo = Conexao::getInstance();
                    try {
                        $update = $pdo->prepare("UPDATE " . $tabela . " SET senha='" . $senha . "' WHERE id=" . $id);
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
                $erro = "Essa é a mesma senha gravada no banco de dados!";
            }

        } else {
            $erro = $obrigatorio;
        }
    }
}

$dados = listarId($tabela,$_GET["id"]);
?>
<div class="panel panel-warning">
    <div class="panel-heading text-center">:.ALTERANDO SENHA DE CLIENTES.:</div>
    <div class="panel-body">
        <form name="alterar" class="form-horizontal" action="" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
            <input type="hidden" name="senha_old" value="<?php echo $dados["senha"]; ?>">

            <div class="form-group">
                <label for="usuario" class="col-sm-4 control-label">Nova Senha: </label>

                <div class="col-sm-8">
                    <input type="text" class="form-control" id="senha" name="senha">
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