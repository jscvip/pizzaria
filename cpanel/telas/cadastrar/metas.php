<?php
if (isset($_POST)) {
    if ($_POST != null) {
       // print_r($_POST);

        if (cadastrar("metas", $_POST)) {
            $sucesso = "Meta gravado com sucesso!";
        } else {
            $erro = "Não foi possivel gravar meta!";
        }
    }
}
?>
<div class="panel panel-success">
    <div class="panel-heading text-center">:.CADASTRAR METAS.:</div>
    <div class="panel-body">
        <form name="cadastrar" class="form-horizontal" action="" method="post">
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="col-sm-12">Escolha uma MetaTag!</label>
                    <?php
                    $pdo = Conexao::getInstance();
                    $tipo_metas = $pdo->prepare("SELECT * FROM tipo_metas");
                    $tipo_metas->execute();
                    if ($tipo_metas->rowCount() > 0) {
                        while ($dados = $tipo_metas->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <label class="radio-inline">
                                <input type="radio" name="tipo_metas" id="<?php echo $dados['id']; ?>"
                                       value="<?php echo $dados['id']; ?>"> <?php echo $dados['nome']; ?>
                            </label>
                        <?php }
                    } ?>
                </div>
            </div>
            <div id="resposta">
                <!-- Aqui entra a resposta-->
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