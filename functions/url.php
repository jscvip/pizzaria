<?php
function carregaUrls($url)
{
    if (is_file("views/" . $url . ".php")) {
        include_once("views/" . $url . ".php");
    } else {
        throw new Exception("Essa pagina não existe");
    }
}