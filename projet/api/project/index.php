<?php

session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/include/classRequire_once.php";

use App\Manager\ProjetManager;

$manager = new ProjetManager();

if(isset($_GET, $_GET["id"], $_GET["ok"])){
    $id = sanitize($_GET["id"]);
    if($_SESSION["role"] === "super_admin"){
        if($_GET["ok"] === "yes"){
            acceptProject($manager, $id);

        }
        else{
            refuseProject($manager, $id);
        }
        header("Location: ../../index.php");
    }
}

/**
 * Accept project creation
 * @param ProjetManager $manager
 * @param int $id
 */
function acceptProject(ProjetManager $manager, int $id){
    $manager->acceptProject($id);
}

/**
 * Refuse project creation
 * @param ProjetManager $manager
 * @param int $id
 */
function refuseProject(ProjetManager $manager, int $id){
    $manager->refuseProject($id);
}