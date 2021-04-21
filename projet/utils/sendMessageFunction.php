<?php
include "../include/userRequire_once.php";

session_start();


$manager = new MessageManager();

$message = new Message();
$message
    ->setIdUser1($_SESSION["user"]->getId())
    ->setIdUser2($_GET["user"])
    ->setText($_POST["message"]);

$manager->sendMessage($message);