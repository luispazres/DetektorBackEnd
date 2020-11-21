<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/motivos.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Motivo($db);

    $item->motivo = isset($_GET['motivo']) ? $_GET['motivo'] : die();

    $item->getSingleMotivo();

    if($item->motivo != null){
        // create array
        $motivo_arr = array(
            "motivo" =>  $item->motivo,
            "des_motivo" => $item->des_motivo,
            "estado" => $item->estado,
            "tipo" => $item->tipo
        );
      
        http_response_code(200);
        echo json_encode($motivo_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Motivo not found.");
    }
?>