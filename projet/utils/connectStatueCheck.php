<?php
    session_start();
    if(isset($_SESSION['connected'])){
        if($_SESSION['connected'] === true){
            $_SESSION["connected"] = false;
            unset($_SESSION["user"]);
            header("Location: ../index.php");
        }
        else{
            header("Location: ../parts/connexion.php");
        }
    }
    else{
        header("Location: ../parts/connexion.php");
    }
?>