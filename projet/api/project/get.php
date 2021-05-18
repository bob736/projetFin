<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/include/classRequire_once.php";

use App\Manager\ProjetManager;
use App\Manager\UserManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];

$manager = new ProjetManager();


switch($requestType) {
    case 'GET':
        if(isset($_GET["id"])){
            if(isset($_GET['action'])){
                if($_GET['action'] === "link"){
                    echo getlink($manager, $_GET["id"]);
                    break;
                }
            }
            else{
                $managerUser = new UserManager();
                echo getProjetData($managerUser, $manager, $_GET["id"]);
                break;
            }
        }
        else{
            echo hasAskForProject($manager);
            break;
        }
        break;
    default:
        break;
}

function hasAskForProject(ProjetManager $manager){
    $datas = $manager->hasAskForProjec();
    $return = [];
    foreach($datas as $data){
        $return[] = [
            "name" => $data
        ];
    }
    return json_encode($return);
}

function getProjetData(UserManager $usermanager, ProjetManager $manager, int $id){
    $project = $manager->getProjetById($id);
    $admission = $manager->getAdmissionById($id);

    $user = $usermanager->getUsernameById($admission["userid"]);

    $return = [
        "name" => $project->getName(),
        "link" => $project->getLink(),
        "username" => $user["name"],
        "message" => $admission["message"],
        "id" => $project->getId()
    ];

    return json_encode($return);
}

function getLink(ProjetManager $manager, int $id){
    $link = $manager->getLink($id);
    echo $manager->checkLink("test");
    return json_encode($link);
}

