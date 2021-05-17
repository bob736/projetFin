<?php


namespace App\Manager;

use App\Traits\GlobalManager;
use App\Entity\Projet;
use App\Manager\UserManager;
use App\Entity\Channel;

class ProjetManager
{
    use GlobalManager;

    /**
     * Return projet datas from database with a certain id
     * @param int $id
     * @return Projet|false
     */
    public function getProjetById(int $id){
        $conn = $this->db->prepare("SELECT * FROM projet INNER JOIN projetuser ON projetuser.projet_id = projet.id WHERE projet.id = :id");
        $conn->bindValue(":id", $id);
        if($conn->execute()){
            $selected = $conn->fetchAll();
            $users = [];
            $manager = new UserManager();
            foreach($selected as $select){
                    $users[] = $manager->getUsernameById($select["user_id"]);
            }
            $projet = new Projet();



            $projet
                ->setName($selected[0]["name"])
                ->setId($selected[0]["projet_id"])
                ->setLink($selected[0]["link"])
                ->setUsers($users);
            return $projet;
        }
        return false;
    }

    public function getProjetByUser(int $id){
        $conn = $this->db->prepare("SELECT * FROM projet INNER JOIN projetuser ON projetuser.projet_id = projet.id WHERE projetuser.user_id = :id");
        $conn->bindValue(":id", $id);
        if($conn->execute()){
            $projets = [];
            $selected = $conn->fetchAll();
            foreach($selected as $select){
                $projet = new Projet();
                //Get channel
                $conn = $this->db->prepare("SELECT * FROM channel WHERE id = :id");
                $conn->bindValue(":id", $select["projet_id"]);
                $channels = [];
                if($conn->execute()){
                    foreach($conn->fetchAll() as $select2){
                        $channel = new Channel();
                        $channel
                            ->setId($select2["id"])
                            ->setName($select2["name"]);
                        $channels[] = $channel;
                    }
                }
                $projet
                    ->setName($select["name"])
                    ->setLink($select["link"])
                    ->setId($select["projet_id"])
                    ->setChannels($channels);
                $projets[] = $projet;
            }
            return $projets;
        }
        return false;
    }

    public function getAllProject(){
        if($_SESSION["role"] === "super_admin"){
            $conn = $this->db->prepare("SELECT * FROM projet");
            if($conn->execute()){
                $projets = [];
                $selected = $conn->fetchAll();
                foreach($selected as $select){
                    $projet = new Projet();
                    //Get channel
                    $conn = $this->db->prepare("SELECT * FROM channel WHERE id = :id");
                    $conn->bindValue(":id", $select["id"]);
                    $channels = [];
                    if($conn->execute()){
                        foreach($conn->fetchAll() as $select2){
                            $channel = new Channel();
                            $channel
                                ->setId($select2["id"])
                                ->setName($select2["name"]);
                            $channels[] = $channel;
                        }
                    }
                    $projet
                        ->setName($select["name"])
                        ->setLink($select["link"])
                        ->setId($select["id"])
                        ->setChannels($channels);
                    $projets[] = $projet;
                }
                return $projets;
            }
            return false;
        }
        else{
            return false;
        }
    }

    public function addProject($name){
        if($_SESSION["role"] === "super_admin"){
            $conn = $this->db->prepare("INSERT INTO projet (name, link) VALUES (:name, :link)");
            $conn->bindValue(":name", $name);
            $conn->bindValue(":link", "link");
            $conn->execute();s
        }
    }
}