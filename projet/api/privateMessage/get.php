<?php

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];


switch($requestType) {
    case 'GET':
//        echo "ok";
        echo json_encode(["message" => "test"]);
        break;
    default:
        break;
}