<?php

function cadastrar($table, $values, $img=null)
{
    $db = Conexao::getInstance(); // CONNECT

    $Query = $db->prepare("SHOW COLUMNS FROM {$table}");
    $Query->execute();

    while ($e = $Query->fetch(PDO::FETCH_ASSOC)) {

        $fields[] = $e['Field'];

    }
    array_shift($fields);
//build the fields
    $buildFields = '';
    if (is_array($fields)) {
//loop through all the fields
        foreach ($fields as $key => $field) {
            if ($key == 0) {
                $buildFields .= $field;
            } else {
                $buildFields .= ', ' . $field;
            }
        }
    } else {
//we are only inserting one field
        $buildFields .= $fields;
    }


//build the values
    $buildValues1 = '';
    if (is_array($values)) {
//loop through all the fields

        if(is_null($img)) {

            foreach ($values as $key => $value) {
                if ($key == "senha") {
                    $buildValues1 .= md5($value) . "*";
                } else {
                    $buildValues1 .= $value . "*";
                }
            }
        }else{
            array_pop($values);
//print_r($values);
            foreach ($values as $key => $value) {
                if ($key == "senha") {
                    $buildValues1 .= md5($value) . "*";
                } else {
                    $buildValues1 .= $value . "*";
                }
            }
            $buildValues1 .= $img."*".$img."*1*";
        }
    } else {
//we are only inserting one field
        $buildValues1 .= "'value'";
    }

    // echo $buildValues1;

    $explode = explode("*",$buildValues1);
    $total = count($explode);

    $buildValues='';
    for($i=0; $i<$total-1; $i++){
        if($i==0) {
            $buildValues .= "'".$explode[$i]."'";
        }else{
            $buildValues .= ",'".$explode[$i]."'";
        }
    }

   // echo $buildValues;

    try {
       //echo "INSERT INTO " . $table . "(" . $buildFields . ") VALUES (" . $buildValues . ")<br>";

        $prepareInsert = $db->prepare("INSERT INTO " . $table . "(" . $buildFields . ") VALUES (" . $buildValues . ")");

        $prepareInsert->execute();
        if ($prepareInsert->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar " . $e->getMessage();
    }


}

?>