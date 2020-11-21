<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/motivos.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Motivo($db);

    $stmt = $items->getMotivos();
    $itemCount = $stmt->rowCount();


    //echo json_encode($itemCount);

    if($itemCount > 0){
        
        $motivoArr = array();
        $motivoArr["body"] = array();
        $motivoArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "motivo" => $motivo,
                "des_motivo" => $des_motivo,
                "estado" => $estado,
                "tipo" => $tipo
            );

            array_push($motivoArr["body"], $e);
        }
        echo json_encode($motivoArr);
        
    }

    else{
        echo json_encode(
            array("body" => array())
        );
    }
?>