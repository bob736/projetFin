<?php
session_start();
if(isset($_SESSION['connected'])){
    if($_SESSION['connected'] === true){
        unset($_SESSION["role"]);
        unset($_SESSION["user1_id"]);
        $_SESSION["connected"] = false;
        header("Location: ../index.php");
    }
    else{
        header("Location: ../parts/connexion.php");
    }
}
else{
    header("Location: ../parts/connexion.php");
}