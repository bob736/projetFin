<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/include/classRequire_once.php";

use App\Manager\ProjetManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];

$manager = new ProjetManager();

switch($requestType) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        if(isset($_GET)){
            if($_GET["action"] === "new"){
                addProject($manager, $data->name);
                break;
            }
            if($_GET["action"] === "admin"){
                setProjectAdmin($manager, $data->id);
                break;
            }
            if($_GET["action"] === "ask"){
                askForProject($manager, $data);
                break;
            }
            if($_GET["action"] === "link"){
                checkLink($manager, $data->link);
            }
        }
        break;
    default:
        break;
}

function addProject(ProjetManager $manager, string $name){
    $manager->addProject($name,"");
}

function setProjectAdmin(ProjetManager $manager, int $id){

}

function askForProject(ProjetManager $manager, array $data){
    $projectName = $data[0];
    $message = $data[1];
    $manager->addProject($projectName, $message);
}

function checkLink(ProjetManager $manager, string $link){
    $result = $manager->checkLink($link);
    if($result !== false){

    }
}

function addUserToProject(ProjetManager $manager){

}