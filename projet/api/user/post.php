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
        followUser($userManager, $data->user);
        break;
    default:
        break;
}

function followUser(UserManager $manager, int $id){
    $manager->followUser($id);
}