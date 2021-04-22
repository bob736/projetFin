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
        echo getPrivateMessage(intval($_GET["user"]),$messageManager);
        break;
    case 'POST':
        break;
    default:
        break;
}

/**
 * @param $id_user2
 * @param $messageManager
 * @return false|string
 */
function getPrivateMessage($id_user2, $messageManager){
    $messages = $messageManager->getMessage($id_user2);
    $response = [];
    foreach($messages as $content){
        $content
            ->setDate(date('l jS \of F Y h:i:s A'));
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