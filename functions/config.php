<?php
$base_url = "http://127.0.0.1:8080/pizzaria/";

class Conexao {
    public static $instance;
    private function __construct() {
    //
    }
    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=localhost;dbname=pizzaria', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        return self::$instance;
    }
}


/**
 * @param null $includes
 * @throws Exception
 */
function carregaIncludes($includes = null){
    if(!is_null($includes)){
        if(is_array($includes)){
            define("PATH_INCLUDE","functions/");
            set_include_path(PATH_INCLUDE);
            foreach($includes as $inc){
                include_once($inc.'.php');
            }
        }else{
            throw new Exception("O parâmetro passado não é um array!");
        }
    }else{
        throw new Exception("Nenhum parâmetro foi passado!");
    }
}