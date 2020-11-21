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

    $data = json_decode(file_get_contents("php://input"));

    $item->des_motivo = $data->des_motivo;
    $item->estado = $data->estado;
    $item->tipo = $data->tipo;
    
    if($item->createMotivo()){
        echo json_encode(array("Error"=>false,"Message"=>'Motivo created successfully.'));
    } else{
        echo json_encode(array("Error"=>true,"Message"=>'Motivo could not be created.'));
    }
?>