<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/include/userRequire_once.php";

use App\Manager\UserManager;
use App\Entity\User;
$userManager = new UserManager();

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];


switch($requestType) {
    case 'GET':
        if(isset($_GET["user"])) {
            if(isset($_GET["action"])){
                if($_GET["action"] === "profile"){
                    echo getUserInfo(intval($_GET["user"]), $userManager);
                    break;
                }
                if($_GET["action"] === "follow"){
                    echo getFollow($userManager,  $_GET["user"]);
                    break;
                }
            }
            else{
                echo getUser(intval($_GET["user"]), $userManager);
                break;
            }
        }
    default:
        break;
}

function getUser(int $id, UserManager $manager) {
    $result = $manager->getUsernameById($id);
    return json_encode($result);
}

function getUserInfo(int $id, UserManager $manager){
    $result = $manager->getAllInfoById($id);
    $editable = "false";
    if($id === $_SESSION["user1_id"]){
        $editable = "true";
    }
    $user = [
        "id" => $result->getId(),
        "name" => $result->getName(),
        "pass" => $result->getPass(),
        "mail" => $result->getMail(),
        "lien" => $result->getLien(),
        "icon" => $result->getIcon(),
        "bio" => $result->getBio(),
        "editable" => $editable
    ];
    return json_encode($user);
}

function getFollow(UserManager $manager, int $id){
    return json_encode([
        "follow" => $manager->getFollow($id),
        "id" => $id,
    ]);
}