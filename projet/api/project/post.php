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
            }
        }
        break;
    default:
        break;
}

function addProject(ProjetManager $manager, string $name){
    $manager->addProject($name);
}

function setProjectAdmin(ProjetManager $manager, int $id){

}