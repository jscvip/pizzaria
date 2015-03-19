<?php
if (isset($_POST)) {
    if ($_POST != null) {
        obrigatorio("Nome", addslashes($_POST["nome"]),"text");
        obrigatorio("Usuário", addslashes($_POST["usuario"]),"text");
        obrigatorio("Senha", addslashes($_POST["senha"]),"text");
        obrigatorio("Nivel", $_POST["nivel"],"select");

        global $obrigatorio;
        if (empty($obrigatorio)) {

            if (verificaCadastro("administradores", "nome", $_POST["nome"])) {
                if (verificaCadastro("administradores", "usuario", $_POST["usuario"])) {

                    if (cadastrar("administradores", $_POST)) {
                        $sucesso = "Administrador gravado com sucesso!";
                        $_POST =null;
                    } else {
                        $erro = "Não foi possivel gravar Administrador!";
                    }
                }else {
                    $erro = "Já existe um Administrador como esse Nome de Usuário: ".$_POST["usuario"];
                }

            } else {
                $erro = "Já existe um Administrador como o Nome: ".$_POST["nome"];
            }

        } else {
            $erro = $obrigatorio;
        }
    }
}
?>
<div class="panel panel-success">
    <div class="panel-heading text-center">:.CADASTRAR ADMINISTRADORES.:</div>
    <div class="panel-body">
        <form name="cadastrar" class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label for="nome" class="col-sm-2 control-label">Nome: </label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nome" name="nome"
                           placeholder="Entre com o nome do Admininstrador" value="<?php if(!empty($_POST['nome'])) echo $_POST['nome']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="usuario" class="col-sm-2 control-label">Usuario: </label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="usuario" name="usuario"
                           placeholder="Entre com o usuario do Admininstrador" value="<?php if(!empty($_POST['usuario'])) echo $_POST['usuario']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="senha" class="col-sm-2 control-label">Senha: </label>

                <div class="col-sm-10">
                    <input type="password" class="form-control" id="senha" name="senha"
                           placeholder="Entre com a senha do Admininstrador" value="<?php if(!empty($_POST['senha'])) echo $_POST['senha']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="nivel" class="col-sm-2 control-label">nivel: </label>

                <div class="col-sm-10">
                    <select class="form-control" id="nivel" name="nivel">
                        <option value="0">Selecione um Nivel</option>
                        <option value="1">Administrador</option>
                        <option value="2">Gerente</option>
                        <option value="3">Padrão</option>
                    </select>
                </div>
            </div>
            <input type="hidden" class="form-control" id="status" name="status" value="0">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 text-right">
                    <button type="submit" class="btn btn-success active">Cadastrar</button>
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