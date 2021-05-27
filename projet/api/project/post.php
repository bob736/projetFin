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
            if($_GET["action"] === "delete"){
                deleteProject($manager, $data->id);
                break;
            }
        }
        break;
    default:
        break;
}

function addProject(ProjetManager $manager, string $name = ""){
    $manager->addProject(sanitize($name),sanitize($name));
}

function setProjectAdmin(ProjetManager $manager, int $id){

}

function askForProject(ProjetManager $manager, array $data){
    $projectName = $data[0];
    $message = $data[1];
    $manager->addProject(sanitize($projectName), sanitize($message));
}

function addUserToProject(ProjetManager $manager){

}

function deleteProject(ProjetManager $manager, int $id){
    $manager->deleteProject($id);
}