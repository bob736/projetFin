<?php
    require_once("function.php");

    require_once("../Classes/DB.php");
    require_once("../Entity/User.php");
    require_once("../Manager/UserManager.php");

    session_start();
    if(isset($_POST, $_POST["mail"], $_POST["pass"])){
        $userManager = new UserManager();
        $mail = sanitize($_POST["mail"]);
        $pass = sanitize($_POST["pass"]);
        $user = $userManager->getUserByMail($mail);
        if(!is_null($user)){
            if($user->getPass() === $pass){
                $_SESSION["user"] = $user;
                $_SESSION["connected"] = true;
            }
            else{
                echo "Mauvais MDP";
            }
        }
        else{
            echo "Mauvais Mail";
        }
    }
?>