<?php

include "./include/userRequire_once.php";

use App\Manager\UserManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];


switch($requestType) {
    case 'GET':
        echo json_encode([["message" => "test"], ["message"=> "bla"]]);
        break;
    default:
        break;
}

function getPrivateMessage($id_user1, $id_user2){
    echo "test";
}