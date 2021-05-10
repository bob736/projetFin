<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/include/userRequire_once.php";

use App\Manager\UserManager;

$userManager = new UserManager();

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];


switch($requestType) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        if(isset($_GET)){
            if($_GET["action"] === "modif"){
                modifProfile($userManager, $data->id, $data->name, $data->bio);
                break;
            }
        }
        else{
            followUser($userManager, $data->user);
            break;
        }
        break;
    default:
        break;
}

function followUser(UserManager $manager, int $id){
    $manager->followUser($id);
}

function modifProfile(UserManager $manager, int $id, string $name, string $bio){
    if($id === $_SESSION["user1_id"]){
        $manager->modifyUser(sanitize($name),sanitize($bio));
    }
}