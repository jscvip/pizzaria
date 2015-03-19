<?php
function gravarLogin($usuario){
    date_default_timezone_set('America/Sao_Paulo');
    $pdo = Conexao::getInstance();

    try{
        $gravarLogin = $pdo->prepare("INSERT INTO login(id_admin,data) VALUES(:admin,:data) ");
        $gravarLogin->bindValue(":admin",$usuario);
        $gravarLogin->bindValue(":data",date("Y-m-d H:i:s"));
        $gravarLogin->execute();

        if($gravarLogin->rowCount()==1){
            return true;
        }else{
            return false;
        }
    }catch (PDOException $e){
        echo "Erro ao gravar dados de login! ";
    }
}

function gravarDados($arquivo){
    date_default_timezone_set('America/Sao_Paulo');

    if(file_exists("functions/".$arquivo)){

        if($arquivo == "sucesso_login.txt"){
            $str ="O Administrador ".$_SESSION['nome_admin']." logou com sucesso em ".date("d/m/Y H:i:s")."\n";
        }else{
            $str ="O Administrador obteve um erro ao logar em ".date("d/m/Y H:i:s")."\n";
        }

        $file = fopen("functions/".$arquivo,"a");
        if($file){
            fputs($file,$str);
        }
    }
}


function logar($usuario, $senha){
    $pdo = Conexao::getInstance();

    try {
        $logar = $pdo->prepare("SELECT * FROM administradores WHERE usuario= :login AND senha= :senha AND status = 1");
        $logar->bindValue(":login", $usuario);
        $logar->bindValue(":senha", md5($senha));
        $logar->execute();
        $dadosLogin = $logar->fetch(PDO::FETCH_ASSOC);

        if($logar->rowCount()==1){
            gravarDados("sucesso_login.txt");

            if(gravarLogin($dadosLogin['id'])) {
                $_SESSION['id_admin'] = $dadosLogin['id'];
                $_SESSION['nome_admin'] = $dadosLogin['nome'];
                $_SESSION['nivel_admin'] = $dadosLogin['nivel'];
                $_SESSION['logado'] = true;

                return true;
            }else{
                return false;
            }
        }else{
            gravarDados("erro_login.txt");

            return false;
        }

    }catch (PDOException $e){
        echo "Erro ao logar no sistema: ".$e->getMessage();
    }
}

function ultimoLogin($id){
    $pdo = Conexao::getInstance();
    try {
        $ultimaVisita = $pdo->prepare("SELECT * FROM login WHERE id_admin = :id ORDER BY data desc Limit 1,1");
        $ultimaVisita->bindValue(":id", $id);
        $ultimaVisita->execute();

        $dados = $ultimaVisita->fetch(PDO::FETCH_ASSOC);
        return $dados["data"];
    }catch (PDOException $e){
        echo "Erro ao pega data de último login! ".$e->getMessage();
    }
}