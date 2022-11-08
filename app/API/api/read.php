<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/equipment.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Equipment($db);
    $stmt = $items->getEquipment();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){

        $equipmentArr = array();
        $equipmentArr["body"] = array();
        $equipmentArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "vendorID" => $vendorID,
                "serial" => $serial,
                "updated_at" => $updated_at,
                "created_at" => $created_at
            );
            $equipmentArr["body"][] = $e;
        }
        echo json_encode($equipmentArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
