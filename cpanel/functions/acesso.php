<?php
function cadastrar($valor = null)
{
    switch($_SESSION["nivel_admin"]){
        case 1:
            $cadastro = array("clientes","ingredientes","pizzas","categorias","administradores","tipo-metas","metas","montar-pizza");
            break;
        case 2:
            $cadastro = array("clientes","ingredientes","pizzas","categorias","administradores","montar-pizza");
            break;
        case 3:
            $cadastro = array("clientes","ingredientes","pizzas","categorias","montar-pizza");
            break;
    }
    try {
        if (in_array($valor, $cadastro)) {
            return true;
        }else{
            return false;
        }
    } catch (PDOException $e) {
        echo "Erro :" . $e->getMessage();
    }

}
function alterar($valor = null)
{
    switch($_SESSION["nivel_admin"]){
        case 1:
            $editar = array("clientes","ingredientes","pizzas","categorias","administradores","tipo-metas","metas","admin-senha","cliente-senha");
            break;
        case 2:
            $editar = array("clientes","ingredientes","pizzas","categorias","administradores","admin-senha","cliente-senha");
            break;
        case 3:
            $editar = array("clientes","ingredientes","pizzas","categorias");
            break;
    }

    try {
        if (in_array($valor, $editar)) {
            return true;
        }else{
            return false;
        }
    } catch (PDOException $e) {
        echo "Erro :" . $e->getMessage();
    }

}
function excluir($valor = null)
{
    switch($_SESSION["nivel_admin"]){
        case 1:
            $excluir = array("clientes","ingredientes","pizzas","categorias","administradores","tipo_metas","metas");
            break;
        case 2:
            $excluir = array("clientes","ingredientes","pizzas","categorias","administradores");
            break;
        case 3:
            $excluir = array("");
            break;
    }

    try {
        if (in_array($valor, $excluir)) {
            return true;
        }else{
            return false;
        }
    } catch (PDOException $e) {
        echo "Erro :" . $e->getMessage();
    }

}