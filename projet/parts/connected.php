<?php
require("./parts/optionClickProfile.php");

require_once("./Classes/DB.php");
require_once("./Entity/User.php");
require_once("./Manager/UserManager.php");

$userManager = new UserManager();
$users = $userManager->getUsers();


foreach($users as $user){
    if(isset($_SESSION, $_SESSION["user"])){
        if($_SESSION["user"]->getId() !== $user->getId()){?>
            <li>
                <div class="profile">
                    <span id="name"><?php echo $user->getName() ?></span>
                    <div id="online-detector">X</div><?php
                    info($user);
                    ?>
                </div>
            </li><?php
        }
    }
    else{?>
        <li>
            <div class="profile">
                <span id="name">Vous devez etre connecté pour voir les personnes en ligne</span>
            </div>
        </li><?php
        break;
    }
}

?>
