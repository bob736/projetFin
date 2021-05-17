<?php

require_once("./include/classRequire_once.php");

use App\Manager\ProjetManager;

$manager = new ProjetManager();
$ask = false;
if(isset($_SESSION["user1_id"])){
    if($_SESSION["role"] === "super_admin"){
        $projets = $manager->getAllProject();
        $ask = true;
    }
    else{
        $projets = $manager->getProjetByUser($_SESSION["user1_id"]);
    }
}
else{
    $projets = [];
}

//set admin flag so only admins of a server will charge addChannel.js
$adminFlag = false;

?>

<li id="projet"><?php
    foreach ($projets as $projet){
        if($manager->isAdmin($_SESSION["user1_id"],$projet->getId())){
            $admin = true;
            $adminFlag = true;
        }else{
            $admin = false;
        }?>
        <div class="projetCont" >
        <h1><?= $projet->getName()?><?php if($projet->getStat() === 0){?>
                <i class="fas fa-question" data-stat = "<?php if(is_int($projet->getStat())){
                    echo $projet->getStat();
                } ?>" data-id="<?= $projet->getId() ?>"></i><?php
            }
            if($admin){?>
                <i data-id="<?= $projet->getId() ?>" class="fas fa-plus addChannel"></i><?php
            }?></h1>
        <ul><?php
            foreach($projet->getChannels() as $channel){?>
                <li><a href="#" data-id="<?= $channel->getId() ?>"><?= $channel->getName() ?></a></li><?php
            }?>
        </ul>
    </div><?php
    }
    if(isset($_SESSION["role"]) && $_SESSION["role"] === "super_admin"){?>
        <div id="addProject"><i class="fas fa-plus"></i></div>
        <script src="./js/utils/addProject.js" type="module"></script>
        <?php
    }
    ?>
</li>
<script src="./js/classes/Request.js" type="module"></script>
<script src="./js/classes/Channel.js" type="module"></script>
<script src="./js/classes/Users.js" type="module"></script>
<script src="./js/utils/channelChat.js" type="module"></script>
<?php if($ask){?>
<script src="./js/utils/projectAdmission.js" type="module"></script><?php
}
if($adminFlag){?>
<script src="./js/utils/addChannel.js" type="module"></script><?php
}
