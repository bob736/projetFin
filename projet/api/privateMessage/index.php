<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/userRequire_once.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/privateMessageRequire_once.php";

use App\Manager\UserManager;
use App\Manager\PrivateMessageManager;
$userManager = new UserManager();
$messageManager = new PrivateMessageManager();

$_SESSION["user1_id"] = 1;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];


switch($requestType) {
    case 'GET':
        echo getPrivateMessage(2,$messageManager);
        break;
    default:
        break;
}

function getPrivateMessage($id_user2, $messageManager){
    $messages = $messageManager->getMessage($id_user2);
    $response = [];
    foreach($messages as $content){
        $response[] = [
            "message" => $content->getText(),
            "date" => $content->getDate(),
        ];
    }
    return json_encode($response);
}


exit;