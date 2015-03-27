<?php
/**
 * @param $tabela
 * @param $campo
 * @param $valor
 */
function verificaCadastro($tabela, $campo, $valor){
    $pdo = Conexao::getInstance();
    try {
        $verificaCadastro = $pdo->prepare("SELECT * FROM " . $tabela . " WHERE " . $campo . " = '" . $valor . "'");
        $verificaCadastro->execute();

        if ($verificaCadastro->rowCount() > 0) {
            return false;
        } else {
            return true;
        }

    } catch (PDOException $e) {
        echo "Erro ao verificar registro Cadastrado " . $e->getMessage();
    }

}
function verificaAlterar($tabela, $campo, $valor, $id){
    //echo "SELECT * FROM " . $tabela . " WHERE " . $campo . " = '" . $valor . "' AND id != '".$id."'";
    $pdo = Conexao::getInstance();
    try {


        $verificaAlterar = $pdo->prepare("SELECT * FROM " . $tabela . " WHERE " . $campo . " = '" . $valor . "' AND id != '".$id."'");
        $verificaAlterar->execute();

        if ($verificaAlterar->rowCount() > 0) {
            return false;
        } else {
            return true;
        }

    } catch (PDOException $e) {
        echo "Erro ao verificar registro Cadastrado " . $e->getMessage();
    }

}

function obrigatorio($nomeCampo="", $campo = null, $tipo=null)
{
    global $obrigatorio;
        if ($campo !== null) {
            if (empty($campo)) {
                if($tipo !==null){
                    if($tipo=="select" AND $campo==0){
                        $obrigatorio .= "O campo " . $nomeCampo . " é obrigatório ! <br>";
                    }else{
                        $obrigatorio .= "O campo " . $nomeCampo . " é obrigatório ! <br>";
                    }
                }
            } else {
                return true;
            }


        }
}

function listar($tabela,$parametros=null){
    $pdo = Conexao::getInstance();
    try{
        if(is_null($parametros)) {
            $listar = $pdo->prepare("SELECT * FROM " . $tabela);
        }else{
            $listar = $pdo->prepare("SELECT * FROM " . $tabela." WHERE ".$parametros);
        }
        $listar->execute();

        if($listar->rowCount() > 0){
            $dados = $listar->fetchAll(PDO::FETCH_ASSOC);
            return $dados;
        }else{
            return false;
        }
    }catch (PDOException $e){
        echo "Erro: ".$e->getMessage();
    }
}

function listarId($tabela, $id, $opcoes = null){
    $pdo = Conexao::getInstance();
    try{
        if($opcoes!==null){
            $op = " ".$opcoes;
        }else{
            $op = "";
        }
        $listar = $pdo->prepare("SELECT * FROM ".$tabela." WHERE id=".$id.$op);
        $listar->execute();

        if($listar->rowCount() > 0){
            $dados = $listar->fetch(PDO::FETCH_ASSOC);
            return $dados;
        }else{
            return false;
        }
    }catch (PDOException $e){
        echo "Erro: ".$e->getMessage();
    }
}

function listarIngredientes($tabela, $id){
    $pdo = Conexao::getInstance();
    try{
        $listar = $pdo->prepare("SELECT * FROM ".$tabela." WHERE id_pizza=".$id);
        $listar->execute();

        if($listar->rowCount() > 0){
            $dados = $listar->fetchAll(PDO::FETCH_ASSOC);
            return $dados;
        }else{
            return false;
        }
    }catch (PDOException $e){
        echo "Erro: ".$e->getMessage();
    }
}

function listarMetas($tabela, $id){
    $pdo = Conexao::getInstance();
    try{
        $listar = $pdo->prepare("SELECT * FROM ".$tabela." WHERE id_tipo_meta=".$id);
        $listar->execute();

        if($listar->rowCount() > 0){
            $dados = $listar->fetch(PDO::FETCH_ASSOC);
            return $dados;
        }else{
            return false;
        }
    }catch (PDOException $e){
        echo "Erro: ".$e->getMessage();
    }
}

function dlConfirma($url,$titulo,$mensagem,$icone){?>
    <form method="POST" action="<?php echo $url; ?>"
          style="display:inline">
        <button class="btn btn-danger quadrado" id="deletar" type="button" data-toggle="modal"
                data-target="#confirmDelete" data-title="<?php echo $titulo;?>"
                data-message="<?php echo $mensagem;?>">
            <i class="glyphicon <?php echo $icone;?>"></i>
        </button>

    </form>
<?php }

function tiraespecialeespaco($string) {

    // matriz de entrada
$what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );

    // matriz de saída
    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_' );

    // devolver a string
    $teste = str_replace($what, $by, $string);
    return str_replace(" ","" , $teste);
}

function listarBusca($tabela,$campoBusca,$busca){
    $pdo = Conexao::getInstance();
    try{
       // echo "SELECT * FROM ".$tabela." WHERE ".$campoBusca." LIKE %".$busca."%";
        $listaBusca = $pdo->prepare("SELECT * FROM ".$tabela." WHERE ".$campoBusca." LIKE '%".$busca."%'");
        $listaBusca->execute();

        if($listaBusca->rowCount()>0){
            $dados = $listaBusca->fetchAll(PDO::FETCH_ASSOC);
            return $dados;
        }else{
            return false;
        }
    }catch (PDOException $e){
        echo "Erro: ".$e->getMessage();
    }
}