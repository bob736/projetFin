<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/channelRequire_once.php";

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];

use App\Manager\ChannelManager;

$manager = new ChannelManager();

switch($requestType) {
    case 'GET':
        if(isset($_GET['action'])){
            if($_GET['action'] === "see") {
                if (isset($_GET["id"])) {
                    echo getMessage($manager, $_GET["id"]);
                    break;
                }
                else {
                    break;
                }
                break;
            }
            if($_GET["action"] === "users"){
                if(isset($_GET["id"])){
                    echo getUsers($manager, intval($_GET["id"]));
                    break;
                }
                else{
                    echo json_encode([0 => false]);
                }
                break;
            }
            if($_GET["action"] === "channels"){
                echo getChannels($manager, $_GET["id"]);
                break;
            }
        }
    default:
        break;
}

/**
 * Get all messages for a certain channel id from database
 * @param ChannelManager $manager
 * @param int $id
 * @return false|string
 */
function getMessage(ChannelManager $manager, int $id){
    $messages = $manager->getMessageByChannelId($id);
    $return = [];
    foreach($messages as $message){
        $return[] = [
            "id" => $id,
            "pseudo" => $message->getUsername(),
            "message" => $message->getText(),
            "date" => $message->getDate(),
            "sent" => $message->getSent()
        ];
    }
    return json_encode($return);
}

/**
 * Return Project's users
 * @param ChannelManager $manager
 * @param int $id
 * @return false|string
 */
function getUsers(ChannelManager $manager, int $id){
    $users = $manager->getUsers($id);
    $return = [];
    foreach($users as $user){
        if($user->getId() !== $_SESSION["user1_id"]){
            $return[] = [
                "name" => $user->getName(),
                "id" => $user->getId()
            ];
        }
    }
    return json_encode($return);
}

/**
 * Return Project's channels
 * @param ChannelManager $manager
 * @param int $id
 * @return false|string
 */
function getChannels(ChannelManager $manager, int $id){
    return json_encode($manager->getChannels($id));
}