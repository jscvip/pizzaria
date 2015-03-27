<?php
if (isset($_POST)) {
    if ($_POST != null) {
        obrigatorio("Nome", addslashes($_POST["nome"]),"text");
        obrigatorio("Endereço", addslashes($_POST["endereco"]),"text");
        obrigatorio("Bairro", addslashes($_POST["bairro"]),"text");
        obrigatorio("CEP", addslashes($_POST["cep"]),"text");
        obrigatorio("Nasc", addslashes($_POST["nasc"]),"text");
        obrigatorio("Email", addslashes($_POST["email"]),"text");
        obrigatorio("Login", addslashes($_POST["login"]),"text");
        obrigatorio("Senha", addslashes($_POST["senha"]),"text");

        if(empty($_POST["fone"]) && empty($_POST["cel"])){
            obrigatorio("Fone",$_POST["fone"],"text");
            obrigatorio("Fone",$_POST["cel"],"text");
        }


        global $obrigatorio;
        if (empty($obrigatorio)) {

            if (verificaCadastro("clientes", "nome", $_POST["nome"])) {
                if (verificaCadastro("Login", "login", $_POST["login"])) {

                    if (cadastro("clientes", $_POST)) {
                        $sucesso = "Cliente gravado com sucesso!";
                        $_POST =null;
                    } else {
                        $erro = "Não foi possivel gravar Cliente!";
                    }
                }else {
                    $erro = "Já existe um Cliente como esse Nome de Usuário: ".$_POST["usuario"];
                }

            } else {
                $erro = "Já existe um Cliente como o Nome: ".$_POST["nome"];
            }

        } else {
            $erro = $obrigatorio;
        }
    }
}
?>
<div class="panel panel-success">
    <div class="panel-heading text-center">:.CADASTRAR CLIENTES.:</div>
    <div class="panel-body">
        <form name="cadastrar" class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label for="nome" class="col-sm-2 control-label">Nome: </label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nome" name="nome"
                           placeholder="Entre com o nome do Cliente" value="<?php if(!empty($_POST['nome'])) echo $_POST['nome']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="endereco" class="col-sm-2 control-label">Endereco: </label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="endereco" name="endereco"
                           placeholder="Entre com o endereco do Cliente" value="<?php if(!empty($_POST['endereco'])) echo $_POST['endereco']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="bairro" class="col-sm-2 control-label">Bairro: </label>

                <div class="col-sm-6">
                    <input type="text" class="form-control" id="bairro" name="bairro"
                           placeholder="Entre com o bairro do Cliente" value="<?php if(!empty($_POST['bairro'])) echo $_POST['bairro']; ?>">
                </div>

                <label for="cep" class="col-sm-1 control-label">Cep: </label>

                <div class="col-sm-3">
                    <input type="text" class="form-control" id="cep" name="cep"
                           placeholder="Entre com o cep do Cliente" value="<?php if(!empty($_POST['cep'])) echo $_POST['cep']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="fone" class="col-sm-2 control-label">Fone: </label>

                <div class="col-sm-4">
                    <input type="tel" class="form-control" id="fone" name="fone" value="<?php if(!empty($_POST['fone'])) echo $_POST['fone']; ?>">
                </div>
                <label for="cel" class="col-sm-2 control-label">Cel: </label>

                <div class="col-sm-4">
                    <input type="tel" class="form-control" id="cel" name="cel" value="<?php if(!empty($_POST['cel'])) echo $_POST['cel']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email: </label>

                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="nasc" class="col-sm-2 control-label">Nasc: </label>

                <div class="col-sm-10">
                    <input type="date" class="form-control" id="nasc" name="nasc"
                           placeholder="Entre com o nasc do Cliente" value="<?php if(!empty($_POST['nasc'])) echo $_POST['nasc']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="login" class="col-sm-2 control-label">Login: </label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="login" name="login"
                           placeholder="Entre com o login do Cliente" value="<?php if(!empty($_POST['login'])) echo $_POST['login']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="senha" class="col-sm-2 control-label">Senha: </label>

                <div class="col-sm-10">
                    <input type="password" class="form-control" id="senha" name="senha"
                           placeholder="Entre com a senha do Cliente" value="<?php if(!empty($_POST['senha'])) echo $_POST['senha']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="observacao" class="col-sm-2 control-label">Observação: </label>

                <div class="col-sm-10">
                    <textarea name="obs" class="form-control" rows="3"><?php if(!empty($_POST['obs'])) echo $_POST['obs']; ?></textarea>
                </div>
            </div>
            <input type="hidden" class="form-control" id="status" name="status" value="1">

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