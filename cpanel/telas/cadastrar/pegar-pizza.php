<?php
include_once('../../../functions/config.php');

$pdo = Conexao::getInstance();
$tipo = $_POST['escolhido'];

try {
    $verificarCadastro = $pdo->prepare("SELECT * FROM pizzas WHERE id_categoria='$tipo'");
    $verificarCadastro->execute();

    if ($verificarCadastro->rowCount() > 0) {
        $dados = $verificarCadastro->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="form-group">
            <select class="form-control" name="pizzaBusca">
                <option value="0">Selecione uma pizza</option>
                <?php
                foreach ($dados as $pizzabusca) {
                    ?>
                    <option value="<?php echo $pizzabusca["id"]; ?>"><?php echo $pizzabusca["nome"]; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success active">OK</button>
        </div>
    <?php
    } else {
        echo "Não há pizza nessa categoria!";
    }
} catch (PDOException $e) {
    echo "Erro ao verificar cadastro de pizzas " . $e->getMessage();
}
?>