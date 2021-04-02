<?php
    session_start();
    if(isset($_SESSION['connected'])){
        if($_SESSION['connected'] === true){
            $_SESSION["connected"] = false;
            header("Location: index.php");
        }
        else{
            header("Location: connexion.php");
        }
    }
    else{
        header("Location: connexion.php");
    }
?>