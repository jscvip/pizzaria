<?php
if (isset($_GET["tab"])) {
$tabela = $_GET["tab"];
$id = $_GET["id"];
$pagina = "index.php?p=listar_" . $tabela;
$dados = listarId($tabela, $id);
?>
<table class="table" xmlns="http://www.w3.org/1999/html">
    <thead>
    <tr>
        <th colspan="2" style="text-align: center; text-transform: uppercase;">
            <?php echo $tabela; ?>
        </th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="2" id="caixa">
            <a href="?p=alterar_<?php echo $tabela;?>&id=<?php echo $id; ?>"
               class=" btn btn-primary quadrado" title="Editar">
                <i class="glyphicon glyphicon-pencil"></i>
            </a>
            <?php
            dlConfirma($pagina . "&acao=deletar&id=" . $id, "Deletar", "Tem certeza que quer deletar " . $dados["nome"] . " ?", "glyphicon-trash");
            ?>
        </td>
    </tr>
    </tfoot>
<?php

         foreach ($dados as $k => $v) {
            ?>
            <tr>
                <td style="text-align: right;"><?php echo $k; ?></td>
                <td><?php echo $v; ?></td>
            </tr>
        <?php }

    }
    ?>
</table>
