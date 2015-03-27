<?php
$tabela = "clientes";
if (isset($_POST)) {
    if ($_POST != null) {

        obrigatorio("Nome", addslashes($_POST["nome"]), "text");
        obrigatorio("Endereço", addslashes($_POST["endereco"]), "text");
        obrigatorio("Bairro", addslashes($_POST["bairro"]), "text");
        obrigatorio("CEP", addslashes($_POST["cep"]), "text");
        obrigatorio("Nasc", addslashes($_POST["nasc"]), "text");
        obrigatorio("Email", addslashes($_POST["email"]), "text");
        obrigatorio("Login", addslashes($_POST["login"]), "text");
        if (empty($_POST["fone"]) && empty($_POST["cel"])) {
            obrigatorio("Fone", $_POST["fone"], "text");
            obrigatorio("Fone", $_POST["cel"], "text");
        }

        global $obrigatorio;
        if (empty($obrigatorio)) {
            $id = $_POST["id"];
            $nome = addslashes($_POST["nome"]);
            $endereco = addslashes($_POST["endereco"]);
            $bairro = addslashes($_POST["bairro"]);
            $cep = $_POST["cep"];
            $nasc = $_POST["nasc"];
            $email = addslashes($_POST["email"]);
            $login = addslashes($_POST["login"]);
            $fone = $_POST["fone"];
            $cel = $_POST["cel"];
            $obs = $_POST["obs"];

            if (verificaAlterar($tabela, "nome", $_POST["nome"], $id)) {
                if (verificaAlterar($tabela, "login", $_POST["login"], $id)) {

                    $pdo = Conexao::getInstance();
                    try {
                        $update = $pdo->prepare("UPDATE " . $tabela . " SET
                        nome='" . $nome . "',
                        endereco='" . $endereco . "',
                        bairro='" . $bairro . "',
                        cep='" . $cep . "',
                        data_nasc='" . $nasc . "',
                        email='" . $email . "',
                        login='" . $login . "',
                        fone_res='" . $fone . "',
                        fone_cel='" . $cel . "',
                        observacao='" . $obs .
                            "' WHERE id=" . $id);
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
                    $erro = "Já existe um Cliente como esse Nome de Usuário: " . $_POST["login"];
                }

            } else {
                $erro = "Já existe um Cliente como o Nome: " . $_POST["nome"];
            }

        } else {
            $erro = $obrigatorio;
        }
    }
}

$dados = listarId($tabela, $_GET["id"]);
?>
<div class="panel panel-warning">
    <div class="panel-heading text-center">:.EDITANDO ADMINISTRADORES.:</div>
    <div class="panel-body">
        <form name="cadastrar" class="form-horizontal" action="" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">

            <div class="form-group">
                <label for="nome" class="col-sm-2 control-label">Nome: </label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nome" name="nome"
                           placeholder="Entre com o nome do Cliente" value="<?php if (!empty($_POST['nome'])) {
                        echo $_POST['nome'];
                    } else {
                        echo $dados["nome"];
                    } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="endereco" class="col-sm-2 control-label">Endereco: </label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="endereco" name="endereco"
                           placeholder="Entre com o endereco do Cliente" value="<?php if (!empty($_POST['endereco'])) {
                        echo $_POST['endereco'];
                    } else {
                        echo $dados["endereco"];
                    } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="bairro" class="col-sm-2 control-label">Bairro: </label>

                <div class="col-sm-6">
                    <input type="text" class="form-control" id="bairro" name="bairro"
                           placeholder="Entre com o bairro do Cliente" value="<?php if (!empty($_POST['bairro'])) {
                        echo $_POST['bairro'];
                    } else {
                        echo $dados["bairro"];
                    } ?>">
                </div>

                <label for="cep" class="col-sm-1 control-label">Cep: </label>

                <div class="col-sm-3">
                    <input type="text" class="form-control" id="cep" name="cep"
                           placeholder="Entre com o cep do Cliente" value="<?php if (!empty($_POST['cep'])) {
                        echo $_POST['cep'];
                    } else {
                        echo $dados["cep"];
                    } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="fone" class="col-sm-2 control-label">Fone: </label>

                <div class="col-sm-4">
                    <input type="tel" class="form-control" id="fone" name="fone"
                           value="<?php if (!empty($_POST['fone'])) {
                               echo $_POST['fone'];
                           } else {
                               echo $dados["fone_res"];
                           } ?>">
                </div>
                <label for="cel" class="col-sm-2 control-label">Cel: </label>

                <div class="col-sm-4">
                    <input type="tel" class="form-control" id="cel" name="cel" value="<?php if (!empty($_POST['cel'])) {
                        echo $_POST['cel'];
                    } else {
                        echo $dados["fone_cel"];
                    } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email: </label>

                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email"
                           value="<?php if (!empty($_POST['email'])) {
                               echo $_POST['email'];
                           } else {
                               echo $dados["email"];
                           } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="nasc" class="col-sm-2 control-label">Nasc: </label>

                <div class="col-sm-10">
                    <input type="date" class="form-control" id="nasc" name="nasc"
                           placeholder="Entre com o nasc do Cliente" value="<?php if (!empty($_POST['nasc'])) {
                        echo $_POST['nasc'];
                    } else {
                        echo $dados["data_nasc"];
                    } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="login" class="col-sm-2 control-label">Login: </label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="login" name="login"
                           placeholder="Entre com o login do Cliente" value="<?php if (!empty($_POST['login'])) {
                        echo $_POST['login'];
                    } else {
                        echo $dados["login"];
                    } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="observacao" class="col-sm-2 control-label">Observação: </label>

                <div class="col-sm-10">
                    <textarea name="obs" class="form-control" rows="3"><?php if (!empty($_POST['obs'])) {
                            echo $_POST['obs'];
                        } else {
                            echo $dados["observacao"];
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