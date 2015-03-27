<?php
$tabela = "administradores";
if (isset($_POST)) {
    if ($_POST != null) {



        obrigatorio("Nome", addslashes($_POST["nome"]),"text");
        obrigatorio("Usuário", addslashes($_POST["usuario"]),"text");
        obrigatorio("Nivel", $_POST["nivel"],"select");

        global $obrigatorio;
        if (empty($obrigatorio)) {
            $id=$_POST["id"];
            $nome=addslashes($_POST["nome"]);
            $usuario=addslashes($_POST["usuario"]);
            $nivel=$_POST["nivel"];
            if (verificaAlterar($tabela, "nome", $_POST["nome"],$id)) {
                if (verificaAlterar($tabela,"usuario", $_POST["usuario"],$id)) {

                    $pdo = Conexao::getInstance();
                    try {
                        $update = $pdo->prepare("UPDATE " . $tabela . " SET nome='" . $nome . "', usuario='".$usuario."', nivel='".$nivel."' WHERE id=" . $id);
                        $update->execute();

                        if ($update->rowCount() == 1) {
                            $sucesso = $tabela." atualizado com sucesso!";
                        } else {
                            $erro = "Não foi possível atualizar ".$tabela."!";
                        }
                    } catch (PDOException $e) {
                        echo "Erro: " . $e->getMessage();
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

$dados = listarId($tabela,$_GET["id"]);
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
                           placeholder="Entre com o nome do Admininstrador" value="<?php if(!empty($_POST['nome'])){echo $_POST['nome'];}else{ echo $dados["nome"];} ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="usuario" class="col-sm-2 control-label">Usuario: </label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="usuario" name="usuario"
                           placeholder="Entre com o usuario do Admininstrador" value="<?php if(!empty($_POST['usuario'])){ echo $_POST['usuario'];}else{ echo $dados["usuario"];} ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="nivel" class="col-sm-2 control-label">nivel: </label>

                <div class="col-sm-10">
                    <select class="form-control" id="nivel" name="nivel">
                        <?php switch($dados["nivel"]){
                            case 1: $nivel = "Administrador";break;
                            case 2: $nivel = "Gerente";break;
                            case 3: $nivel = "Padrão";break;
                        }?>
                        <option value="<?php echo $dados["nivel"];?>"><?php echo $nivel;?></option>
                        <option value="1">Administrador</option>
                        <option value="2">Gerente</option>
                        <option value="3">Padrão</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 text-right">
                    <button type="submit" class="btn btn-warning active">Atualizar</button>
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