<?php
$pagina = "index.php?p=listar_administradores";
$tabela = "administradores";

if (isset($_GET)) {
    if ($_GET != null) {
        if (isset($_GET["acao"])) {
            if ($_GET["acao"] == "status") {
                $id = $_GET["id"];

                if ($_GET["sts"] == 0) {
                    $status = 1;
                } else {
                    $status = 0;
                }
                $pdo = Conexao::getInstance();
                try {
                    $update = $pdo->prepare("UPDATE " . $tabela . " SET status=" . $status . " WHERE id=" . $id);
                    $update->execute();

                    if ($update->rowCount() == 1) {
                        $sucesso = "Status atualizado com sucesso!";
                    } else {
                        $erro = "Não foi possível atualizar status!";
                    }
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
                ?>
            <?php }elseif ($_GET["acao"] == "deletar") {
                $id = $_GET["id"];
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
            }
        }
    }
}
?>
<div class="panel panel-info">
    <div class="panel-heading text-center">:.LISTADO ADMINISTRADORES.:</div>
    <div class="panel-body">
        <?php $dados = listar($tabela); ?>
        <table class="table table-hover" style="margin-bottom: 0;">
            <thead>
            <tr>
                <th>NOME</th>
                <th>USUÁRO</th>
                <th>NIVEL</th>
                <th>STATUS</th>
                <th>AÇÃO</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once 'biblioteca/Pager/Pager.php';
            $params = array(
                'itemData' => $dados,
                'perPage' => 5,
                'delta' => 7,
                'attributes'=>"class='pg btn btn-default'",
                'curPageLinkClassName'=>'btn btn-info cur',
                //'append' => true,
                //'separator' => ' | ',
                //'clearIfVoid' => false,
                //'urlVar' => 'entrant',
                //'useSessions' => true,
                //'closeSession' => true,
                //'mode'  => 'Sliding',    //try switching modes,
                'mode' => 'Jumping',
            );
            $pager = & Pager::factory($params);
            $page_data = $pager->getPageData();
            $links = $pager->getLinks();
            foreach ($page_data as $admin) { ?>
                <tr>
                    <td style="padding: 2px;">
                        <?php echo $admin["nome"]; ?>
                    </td>
                    <td style="padding: 2px;">
                        <?php echo $admin["usuario"]; ?>
                    </td>
                    <td style="padding: 2px; text-align: center;">
                        <?php
                        switch ($admin["nivel"]) {
                            case 1:
                                ?>
                                <div class="alert-success">Administrador</div>
                                <?php break;?>
                            <?php case 2: ?>
                            <div class="alert-info">Gerente</div>
                            <?php break; ?>
                        <?php case 3: ?>
                            <div class="alert-warning">Padrão</div>
                            <?php break; ?>
                        <?php default: ?>
                            <div class="alert-danger">Outro</div>
                            <?php break; ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: center; padding: 2px;">
                        <?PHP if ($admin["status"] == 0) { ?>
                            <a href="<?php echo $pagina; ?>&acao=status&id=<?PHP echo $admin["id"]; ?>&sts=0"
                               class="btn btn-danger btn-mini btn-circle"><i class="glyphicon glyphicon-remove"></i></a>
                        <?PHP } elseif ($admin["status"] == 1) { ?>
                            <a href="<?php echo $pagina; ?>&acao=status&id=<?PHP echo $admin["id"]; ?>&sts=1"
                               class="btn btn-success btn-mini btn-circle"><i class="glyphicon glyphicon-ok"></i></a>
                        <?PHP } ?>
                    </td>
                    <td style="text-align: center; padding: 2px;">
                        <a href="?p=alterar_administradores&id=<?php echo $admin["id"]; ?>"class=" btn btn-primary quadrado" title="Editar">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <form method="POST" action="<?php echo $pagina; ?>&acao=deletar&id=<?php echo $admin["id"]; ?>" style="display:inline">
                            <button class="btn btn-danger quadrado" id="deletar" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Deletar" data-message="Tem certeza que quer deletar esse administrador ?">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>

                        </form>
                        <a href="?p=alterar_admin-senha&id=<?php echo $admin["id"]; ?>" class=" btn btn-warning quadrado" title="Alterar Senha">
                            <i class="glyphicon glyphicon-erase"></i>
                        </a>
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