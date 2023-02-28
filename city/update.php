<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../models/city.php';

$database = new Database();
$db = $database->getConnection();

$city = new City($db);


parse_str(file_get_contents('php://input', TRUE), $_UPDATE);


if (!empty($_UPDATE['id'])) {
    $city->id = $_UPDATE['id'];

    $city->name = $_UPDATE['name'];




    if ($city->update()) {

        http_response_code(200);


        echo json_encode(array("message" => "Город был обновлён"), JSON_UNESCAPED_UNICODE);
    }
    else {

        http_response_code(503);

        echo json_encode(array("message" => "Невозможно обновить город"), JSON_UNESCAPED_UNICODE);
    }
}


