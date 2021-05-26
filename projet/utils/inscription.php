<?php

require_once $_SERVER["DOCUMENT_ROOT"]. "/Classes/DB.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Trait/Manager.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Manager/UserManager.php";

use App\Manager\UserManager;

if(isset($_POST["mail"], $_POST["pass"], $_POST["name"])){
    $manager = new UserManager();
    $mail = sanitize($_POST["mail"]);
    $pass = sanitize($_POST["pass"]);
    $name = sanitize($_POST["name"]);
    $manager->newUser($mail,$pass,$name);
    header("Location: ../index.php");
}