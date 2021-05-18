<?php

require_once dirname(__FILE__) . "/../Classes/DB.php";
require_once dirname(__FILE__) . "/../Trait/Manager.php";
require_once dirname(__FILE__) . "/../Manager/ProjetManager.php";

use App\Manager\ProjetManager;

$manager = new ProjetManager();

$manager->checkLinkDuration();