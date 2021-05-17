<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/channelRequire_once.php";

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];

use App\Manager\ChannelManager;

$manager = new ChannelManager();

switch($requestType) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        if(isset($_GET,$_GET['action'])){
            if($_GET['action'] === "new"){
                newChannel($manager,$data->id,$data->name);
                break;
            }
        }
        else{
            sendChannelMessage($manager, $data->message, $data->data);
        }


    default:
        break;
}

function sendChannelMessage(ChannelManager $manager, string $message, int $channel){
    $manager->sendMessage($message, $channel);
}

function newChannel(ChannelManager $manager, int $id, string $name){
    $manager->addChannel($id,$name);
}