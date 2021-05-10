<?php

require_once("./include/classRequire_once.php");

use App\Manager\ProjetManager;

$manager = new ProjetManager();

$manager->getProjetById(1);

?>


<li id="projet">
    <div class="projetCont">
        <h1>Projet Name</h1>
        <ul>
            <li><a href="">Lorem ipsum dolor sit ameezet</a></li>
            <li><a href="">Lorem ipsum dolor sit amet</a></li>
            <li><a href="">Lorem ipsum dolor sit amet</a></li>
            <li><a href="">Lorem ipsum dolor sit amet</a></li>
            <li><a href="">Lorem ipsum dolor sit amet</a></li>
        </ul>
    </div>
</li>