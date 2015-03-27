<?php
$pagina = "index.php?p=listar_ingredientes";
$tabela = "ingredientes";

if (isset($_GET)) {
    if ($_GET != null) {
        if (isset($_GET["acao"])) {
            if ($_GET["acao"] == "deletar") {
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];

                    if (excluir($tabela)) {

                        $pdo = Conexao::getInstance();
                        try {
                            $update = $pdo->prepare("DELETE FROM " . $tabela . " WHERE id=" . $id);
                            $update->execute();

                            if ($update->rowCount() == 1) {
                                $sucesso = "Deletado com sucesso!";
                            } else {
                                $erro = "Não foi possível Deletar!";
                            }
                        } catch (PDOException $e) {
                            echo "Erro: " . $e->getMessage();
                        }
                    } else {
                        $erro = "Você não tem permissão para essa ação!";
                    }
                }
            }
        }
    }
}
?>
<div class="panel panel-info">
    <div class="panel-heading text-center">:.LISTANDO INGREDIENTES.:</div>
    <div class="panel-body">
        <?php $dados = listar($tabela); ?>
        <table class="table table-hover" style="margin-bottom: 0;">
            <thead>
            <tr>
                <th>ID</th>
                <th>INGREDIENTE</th>
                <th>VALOR</th>
                <th style="text-align: center;">AÇÃO</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once 'biblioteca/Pager/Pager.php';
            $params = array(
                'itemData' => $dados,
                'perPage' => 10,
                'delta' => 7,
                'attributes' => "class='pg btn btn-default'",
                'curPageLinkClassName' => 'btn btn-info cur',
                'mode' => 'Jumping',
            );
            $pager = &Pager::factory($params);
            $page_data = $pager->getPageData();
            $links = $pager->getLinks();
            foreach ($page_data as $d) { ?>
                    <tr>
                        <td style="padding: 2px;">
                            <?php echo $d["id"]; ?>
                        </td>
                        <td style="padding: 2px;">
                            <?php echo $d["nome"]; ?>
                        </td>
                        <td style="padding: 2px;">
                            R$ <?php echo number_format($d["valor"],2,",","."); ?>
                        </td>
                        <td style="text-align: center; padding: 2px;">
                            <a href="?p=alterar_<?php echo $tabela;?>&id=<?php echo $d["id"]; ?>" class=" btn btn-primary quadrado"
                               title="Editar">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            <?php if (excluir($tabela)) {
                                dlConfirma($pagina . "&acao=deletar&id=" . $d["id"], "Deletar Ingrediente", "Tem certeza que quer deletar esse Ingrediente? Ao Deletar esse ingrediente as pizzas vinculadas a ele também serão excluidas!", "glyphicon-trash");
                            } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>


        </table>
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
    <div class="pager">
        <?php
        echo $links['all'];
        ?>
    </div>
</div>