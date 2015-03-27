<?php
if (isset($_POST)) {
    if ($_POST != null) {
        if(verificaCadastro("tipo_metas","nome",$_POST["meta"])) {

            if (cadastro("tipo_metas", $_POST)) {
                $sucesso = "Tipo de Meta gravado com sucesso!";
            } else {
                $erro = "Não foi possivel gravar tipo de meta!";
            }

        }else{
            $erro = "Esse tipo de meta já existe!";
        }
    }
}
?>
<div class="panel panel-success">
    <div class="panel-heading text-center">:.CADASTRAR TIPO DE METAS.:</div>
    <div class="panel-body">
        <form name="cadastrar" class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label for="meta" class="col-sm-3 control-label">Tipo de Meta: </label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" id="meta" name="meta"
                           placeholder="Entre com a Meta">
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