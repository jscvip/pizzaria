<h1>Registros encontrados</h1>
<?php
include_once('../../functions/config.php');
include_once('../functions/utils.php');
$busca = $_POST["busca"];

$bd = "pizzaria";
$pdo = Conexao::getInstance();
try {
    $tabelas = $pdo->prepare("SHOW TABLES");
    $result = $tabelas->execute();

    if (!$result) {
        echo "DB Error, could not list tables\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    $row = $tabelas->fetchAll(PDO::FETCH_ASSOC);

    foreach ($row as $banco => $tabR) {
        foreach ($tabR as $t => $tab) {
            $pdo2 = Conexao::getInstance();
            $campos = $pdo2->prepare("SHOW COLUMNS FROM ".$tab);
            $res = $campos->execute();
            if (!$res) {
                echo 'Could not run query: ' . mysql_error();
                exit;
            }
            if ($campos->rowCount() > 0) {
                while ($r = $campos->fetchAll(PDO::FETCH_ASSOC)) {
                    foreach ($r as $k => $c) {
                        if(substr_count($c["Type"],"varchar")>0) {
                            $dados = listarBusca($tab, $c["Field"], $busca);

                            if($dados!=false) {
                                foreach($dados as $d){?>
                                    <p>Na tabela <?php echo $tab;?> - <?php echo $c["Field"] ." = ".$d[$c["Field"]] ;?> <a class="btn btn-primary" style=" margin-left: 10px; padding: 0 3px;" href="?p=view_busca&tab=<?php echo $tab;?>&id=<?php echo $d["id"];?>"> Visualizar</a></p>
                                <?php }

                            }
//echo $tab." - ".$c["Field"] . "<br>";
                        }
                    }
                }
            }
        }
    }


} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}



?>
