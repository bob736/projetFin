<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/channelRequire_once.php";

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];

use App\Manager\ChannelManager;

$manager = new ChannelManager();

switch($requestType) {
    case 'GET':
        if(isset($_GET['action'])){
            if($_GET['action'] === "see"){
                echo getMessage($manager, $_GET["channel"]);
                break;
            }
        }
        else{

            break;
        }
    default:
        break;
}


//Get all messages for a certain channel id from database
function getMessage(ChannelManager $manager, int $id){
    $messages = $manager->getMessageByChannelId($id);
    $return = [];
    foreach($messages as $message){
        $return[] = [
            "id" => $id,
            "pseudo" => $message->getUsername(),
            "message" => $message->getText(),
            "date" => $message->getDate(),
        ];
    }
    return json_encode($return);
}