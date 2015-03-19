<?php
include_once('../../../functions/config.php');

$pdo = Conexao::getInstance();
$tipo = $_POST['escolhido'];

try {
    $verificarCadastro = $pdo->prepare("SELECT * FROM metas INNER JOIN tipo_metas
                                        ON metas.id_tipo_meta = tipo_metas.id WHERE id_tipo_meta='$tipo'");
    $verificarCadastro->execute();

    if ($verificarCadastro->rowCount() > 0) {
        echo "Essa meta ja ta´cadastrada!";
    } else {

        ?>
        <div class="form-group">
            <textarea class="form-control" name="meta"></textarea>
       </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10 text-right">
                <button type="submit" class="btn btn-success active">Cadastrar</button>
            </div>
        </div>
    <?php
    }
} catch (PDOException $e) {
    echo "Erro ao verificar cadastro de metas " . $e->getMessage();
}
?>