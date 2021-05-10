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
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        sendPrivateMessage($messageManager, $data);
        break;
    default:
        break;
}


function sendPrivateMessage(PrivateMessageManager $messageManager, $data){
    $messageManager->sendMessage($data->user,$data->message);
}