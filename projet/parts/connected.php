<?php
require("./parts/optionClickProfile.php");

require_once("./Classes/DB.php");
require_once("./Entity/User.php");
require_once("./Manager/UserManager.php");

use App\Manager\UserManager;

$userManager = new UserManager();
$users = $userManager->getFollowedUsers();


foreach($users as $user){
    if($connected){
        if($_SESSION["user1_id"] !== $user->getId()){?>
            <li>
                <div class="profile">
                    <span id="name"><?php echo $user->getName() ?></span><?php
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
