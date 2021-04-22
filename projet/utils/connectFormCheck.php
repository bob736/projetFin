<?php
    include "../include/userRequire_once.php";

    use App\Manager\UserManager;

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
                header("Location: ../index.php");
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