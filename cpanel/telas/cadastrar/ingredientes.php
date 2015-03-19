<?php
if (isset($_POST)) {
    if ($_POST != null) {
        if ($_POST["ingrediente"] != "") {
            if(verificaCadastro("ingredientes","nome",$_POST["ingrediente"])) {

                if (cadastrar("ingredientes", $_POST)) {
                    $sucesso = "Ingredientes gravada com sucesso!";
                } else {
                    $erro = "Não foi possivel gravar ingrediente!";
                }

            }else{
                $erro = "Essa ingrediente já existe!";
            }
        } else {
            $erro = "O campo ingrediente deve ser preenchido!";
        }
    }
}
?>
<div class="panel panel-success">
    <div class="panel-heading text-center">:.CADASTRAR INGREDIENTES.:</div>
    <div class="panel-body">
        <form name="cadastrar" class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label for="ingrediente" class="col-sm-2 control-label">Ingrediente: </label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ingrediente" name="ingrediente"
                           placeholder="Entre com a Ingrediente">
                </div>
            </div>
            <div class="form-group">
                <label for="valor" class="col-sm-2 control-label">Valor: </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="valor" name="valor"
                           placeholder="Entre com o valor">
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