<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/userRequire_once.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/privateMessageRequire_once.php";

use App\Manager\UserManager;
use App\Manager\PrivateMessageManager;
$userManager = new UserManager();
$messageManager = new PrivateMessageManager();

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];


switch($requestType) {
    case 'GET':
        echo getPrivateMessage(intval($_GET["user"]),$messageManager);
        break;
    default:
        break;
}

/**
 * Return json object of an array of Message
 * @param $id_user2
 * @param PrivateMessageManager $messageManager
 * @return false|string
 */
function getPrivateMessage($id_user2, PrivateMessageManager $messageManager){
    $messages = $messageManager->getMessage($id_user2);
    $response = [];
    foreach($messages as $content){
        $response[] = [
            "message" => $content->getText(),
            "date" => $content->getDate(),
            "sent" => $content->getSent(),
            "pseudo" => $content->getUsername(),
        ];
    }
    return json_encode($response);
}



exit;