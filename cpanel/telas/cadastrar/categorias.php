<?php
if (isset($_POST)) {
    if ($_POST != null) {
        if ($_POST["categoria"] != "") {
            if(verificaCadastro("categorias","nome",$_POST["categoria"])) {

                if (cadastrar("categorias", $_POST)) {
                    $sucesso = "Categorias gravada com sucesso!";
                } else {
                    $erro = "Não foi possivel gravar categoria!";
                }

            }else{
                $erro = "Essa categoria já existe!";
            }
        } else {
            $erro = "O campo categoria deve ser preenchido!";
        }
    }
}
?>
<div class="panel panel-success">
    <div class="panel-heading text-center">:.CADASTRAR CATEGORIAS.:</div>
    <div class="panel-body">
        <form name="cadastrar" class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label for="categoria" class="col-sm-2 control-label">Categoria: </label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="categoria" name="categoria"
                           placeholder="Entre com a Categoria">
                </div>
            </div>
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
                 style="margin: 0; padding: 5px;"><?php echo $sucesso;?></div>
        <?php }
    }
    if (isset($erro)) {
        if (!empty($erro)) {
            ?>
            <div class="alert alert-danger" role="alert" style="margin: 0; padding: 5px;"><?php echo $erro;?></div>
        <?php }
    } ?>
</div>