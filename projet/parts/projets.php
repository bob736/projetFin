<?php

require_once("./include/classRequire_once.php");

use App\Manager\ProjetManager;

$manager = new ProjetManager();
$projets = $manager->getProjetByUser($_SESSION["user1_id"]);?>

<li id="projet"><?php
    foreach ($projets as $projet){?>
        <div class="projetCont">
        <h1><?= $projet->getName() ?></h1>
        <ul>
            <li><a href="">Lorem ipsum dolor sit ameezet</a></li>
            <li><a href="">Lorem ipsum dolor sit amet</a></li>
            <li><a href="">Lorem ipsum dolor sit amet</a></li>
            <li><a href="">Lorem ipsum dolor sit amet</a></li>
            <li><a href="">Lorem ipsum dolor sit amet</a></li>
        </ul>
    </div><?php
    }
    ?>

</li>