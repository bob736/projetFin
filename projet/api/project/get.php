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
                if($_GET["action"] === "check"){
                    echo checkAsk($manager, $_GET["id"]);
                }
            }
            else{
                $managerUser = new UserManager();
                echo getProjetData($managerUser, $manager, $_GET["id"]);
                break;
            }

        }
        else{
            if(isset($_GET["action"])){
                if($_GET['action'] === "checkToken"){
                    if(isset($_GET["token"])){
                        echo checkToken($manager, $_GET["token"]);
                        break;
                    }
                }
            }
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
    return json_encode($link);
}

function checkToken(ProjetManager $manager, string $link){
    $result = $manager->checkLink($link);
    if($result !== false){
        $server = $manager->getProjet($result);
        if($manager->addUserToProject($server->getId())){
            return json_encode(["check" => true, "server" => $server->getName()]);
        }
        else{
            return json_encode(["check" => false]);
        }
    }
    else{
        return json_encode(["check" => false]);
    }
}

function checkAsk(ProjetManager $manager, int $id){
    $result = $manager->checkAsk($id);
}