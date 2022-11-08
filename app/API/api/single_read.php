<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/equipment.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Equipment($db);
    $item->id = $_GET['id'] ?? die();

    $item->getSingleEquipment();
    if($item->id !== null){
        // create array
        $equi_arr = array(
            "id" =>  $item->id,
            "vendorID" => $item->vendorID,
            "serial" => $item->serial,
            "created_at" => $item->created_at,
            "updated_at" => $item->updated_at

        );

        http_response_code(200);
        echo json_encode($equi_arr);
    }

    else{
        http_response_code(404);
        echo json_encode("Equipment not found.");
    }
