<?php
$pagina = "index.php?p=listar_clientes";
$tabela = "clientes";

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
            <?php } elseif ($_GET["acao"] == "deletar") {
                if(isset($_GET["id"])) {
                    $id = $_GET["id"];

                    if(excluir($tabela)) {

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
                    }else{
                        $erro = "Você não tem permissão para essa ação!";
                    }
                }
            }
        }
    }
}
?>
<div class="panel panel-info">
    <div class="panel-heading text-center">:.LISTANDO ADMINISTRADORES.:</div>
    <div class="panel-body">
        <?php $dados = listar($tabela); ?>
        <table class="table table-hover" style="margin-bottom: 0;">
            <thead>
            <tr>
                <th>NOME</th>
                <th>USUÁRO</th>
                <th>NASC.</th>
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
                'mode' => 'Jumping',
            );
            $pager = & Pager::factory($params);
            $page_data = $pager->getPageData();
            $links = $pager->getLinks();
            foreach ($page_data as $d) { ?>
                <tr>
                    <td style="padding: 2px;">
                        <?php echo $d["nome"]; ?>
                    </td>
                    <td style="padding: 2px;">
                        <?php echo $d["login"]; ?>
                    </td>
                    <td style="padding: 2px; text-align: center;">
                        <?php  echo $d["data_nasc"];  ?>
                    </td>
                    <td style="text-align: center; padding: 2px;">
                        <?PHP if ($d["status"] == 0) { ?>
                            <a href="<?php echo $pagina; ?>&acao=status&id=<?PHP echo $d["id"]; ?>&sts=0"
                               class="btn btn-danger btn-mini btn-circle"><i class="glyphicon glyphicon-remove"></i></a>
                        <?PHP } elseif ($d["status"] == 1) { ?>
                            <a href="<?php echo $pagina; ?>&acao=status&id=<?PHP echo $d["id"]; ?>&sts=1"
                               class="btn btn-success btn-mini btn-circle"><i class="glyphicon glyphicon-ok"></i></a>
                        <?PHP } ?>
                    </td>
                    <td style="text-align: center; padding: 2px;">
                        <a href="?p=alterar_clientes&id=<?php echo $d["id"]; ?>"class=" btn btn-primary quadrado" title="Editar">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <?php if(excluir($tabela)){
                            dlConfirma($pagina."&acao=deletar&id=".$d["id"],"Deletar Cliente","Tem certeza que quer deletar esse Cliente ?","glyphicon-trash");
                        }?>
                        <a href="?p=alterar_cliente-senha&id=<?php echo $d["id"]; ?>"
                           class=" btn btn-warning quadrado" title="Alterar Senha">
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