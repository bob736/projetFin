<?php

require_once("./include/classRequire_once.php");

use App\Manager\ProjetManager;

$manager = new ProjetManager();
if(isset($_SESSION["user1_id"])){
    if($_SESSION["role"] === "super_admin"){
        $projets = $manager->getAllProject();
    }
    else{
        $projets = $manager->getProjetByUser($_SESSION["user1_id"]);
    }

}
else{
    $projets = [];
}
?>

<li id="projet"><?php
    foreach ($projets as $projet){?>
        <div class="projetCont">
        <h1><?= $projet->getName() ?></h1>
        <ul><?php
        foreach($projet->getChannels() as $channel){?>
            <li><a href="#" data-id="<?= $channel->getId() ?>"><?= $channel->getName() ?></a></li><?php
        }
        ?>

        </ul>
    </div><?php
    }
    if($_SESSION["role"] === "super_admin"){?>
        <div id="addProject"><i class="fas fa-plus"></i></div>
        <script src="./js/utils/addProject.js"></script>
        <?php
    }
    ?>
</li>
<script src="./js/classes/Request.js" type="module"></script>
<script src="./js/classes/Channel.js" type="module"></script>
<script src="./js/utils/channelChat.js" type="module"></script>