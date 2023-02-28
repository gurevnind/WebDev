<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../models/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


parse_str(file_get_contents('php://input', TRUE), $_UPDATE);


if (!empty($_UPDATE['id'])) {
    $user->id = $_UPDATE['id'];


    $user->name = $_UPDATE['name'];
    $user->username = $_UPDATE['username'];
    $user->city_id = $_UPDATE['city_id'];


    if ($user->update()) {

        http_response_code(200);


        echo json_encode(array("message" => "Пользователь был обновлён"), JSON_UNESCAPED_UNICODE);
    }
    else {

        http_response_code(503);

        echo json_encode(array("message" => "Невозможно обновить пользователя"), JSON_UNESCAPED_UNICODE);
    }
}

