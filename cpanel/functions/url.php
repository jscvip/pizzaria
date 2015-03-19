<?php
function carregaUrls($url){
    $caminho = str_replace("_","/",$url);
    if(is_file("telas/".$caminho.".php")){
        include_once("telas/".$caminho.".php");
    }else{
        throw new Exception("Essa pagina não existe");
    }
}