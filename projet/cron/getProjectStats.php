<?php

session_start();
$_SESSION["role"] ="super_admin";

require_once dirname(__FILE__) . "/../Classes/DB.php";
require_once dirname(__FILE__) . "/../Trait/Manager.php";
require_once dirname(__FILE__) . "/../Trait/Entity.php";
require_once dirname(__FILE__) . "/../Entity/Projet.php";
require_once dirname(__FILE__) . "/../Manager/ProjetManager.php";

use App\Manager\ProjetManager;
use App\Entity\Projet;

$manager = new ProjetManager();
$projects = $manager->getAllProject();
$stats = [];

$next = false;


/**
 * @var Projet $project
 */
foreach ($projects as $project){
    $link = $project->getLink();
    echo $link . "<br>";
    $stats = [];
    try {
        if (getVerifLinkContent($link, 0) !== false) {
            //$manager->updateProjectLinkVerif($project->getId(), $project->getLink(), 1);
            $page = 0;
            while(true){
                $stat = getVerifLinkContent($link, $page);
                echo "<pre>";
                print_r($stat);
                echo "</pre>";
                $page++;
                if($page > 5 ){
                    break;
                }
            }

            echo "<pre>";
            print_r($stats);
            echo "</pre>";

        }
        else{
            $manager->updateProjectLinkVerif($project->getId(), $project->getLink(), 0);
            echo getVerifLinkContent($link, 0);
        }
    } catch (Throwable $e) {

    }
}


function getVerifLinkContent(string $link, int $page){
    $ch = curl_init();
    try{
        curl_setopt($ch, CURLOPT_URL, "https://api.github.com/repos/$link/events?page=$page");
        $config['useragent'] = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';
        curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responses = curl_exec($ch);
        if (curl_errno($ch)) {
            echo curl_error($ch);
            die();
        }

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($http_code == 200){
            echo gettype($responses);
            echo "ok";
            return $responses;

        }
        else{
            echo $link ."<br>";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.github.com/rate_limit");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
            $stats = json_decode(curl_exec($ch));
            $date = new DateTime();
            $date->setTimestamp($stats->rate->reset);
            echo "<pre>";
            print_r($stats);
            echo "</pre>";
            echo $date->format('U = Y-m-d H:i:s') . "<br>";
            return false;

        }
    }
    catch (\Throwable $th)
    {
        throw $th;
        return false;
    }
    finally {
        curl_close($ch);
    }
}

session_abort();


