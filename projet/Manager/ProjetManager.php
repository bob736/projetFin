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

    /**
     * Get all project where user is admin
     * @param int $id
     * @return array|false
     */
    public function getProjetByUser(int $id){
        $conn = $this->db->prepare("SELECT * FROM projet INNER JOIN projetuser ON projetuser.projet_id = projet.id INNER JOIN projetadmission ON projetadmission.statue = 1 WHERE projetadmission.projet_id = projet.id AND projetuser.user_id = :id ");
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

    /**
     * Return all project ( super_admin fonction )
     * @return array|false
     */
    public function getAllProject(){
        if($_SESSION["role"] === "super_admin"){
            $conn = $this->db->prepare("SELECT * FROM projet");
            if($conn->execute()){
                $projets = [];
                $selected = $conn->fetchAll();
                foreach($selected as $select){
                    $projet = new Projet();
                    //Get project's channels
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

                    $conn = $this->db->prepare("SELECT statue, message FROM projetadmission WHERE projet_id = :id");
                    $conn->bindValue(":id", $select["id"]);
                    $conn->execute();
                    $state = $conn->fetch();

                    $projet
                        ->setStat($state["statue"])
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

    /**
     * Create a project in database
     * @param $name
     * @param $message
     */
    public function addProject($name, $message){
        $conn = $this->db->prepare("INSERT INTO projet (name, link) VALUES (:name, :link)");
        $conn->bindValue(":name", $name);
        $conn->bindValue(":link", "link");
        $conn->execute();

        $id = $this->db->lastInsertId();

        $conn = $this->db->prepare("INSERT INTO projetadmission (user_id, projet_id, message, statue) VALUES (:userid, :projetid, :message, :statue)");
        $conn->bindValue(":userid", $_SESSION["user1_id"]);
        $conn->bindValue(":projetid", $id);

        //If user is a super_admin then project is directly admit
        if($_SESSION["role"] === "super_admin"){
            $conn->bindValue(":message", "Added by an admin");
            $conn->bindValue(":statue", 1);
        }
        else{
            $conn->bindValue(":message", $message);
            $conn->bindValue(":statue", 0);
        }

        $conn->execute();

        $conn = $this->db->prepare("INSERT INTO projetuser (projet_id, user_id) VALUES (:projetid, :userid)");
        $conn->bindValue(":projetid", $id);
        $conn->bindValue(":userid", $_SESSION["user1_id"]);
        $conn->execute();


    }

    /**
     * return Project's user already in ask stats
     * @return array
     */
    public function hasAskForProjec(){
        $conn = $this->db->prepare("SELECT * FROM projet INNER JOIN projetuser ON projetuser.projet_id = projet.id INNER JOIN projetadmission ON projetadmission.projet_id = projet.id WHERE projetadmission.statue = 0 AND projetuser.user_id = :id ");
        $conn->bindValue(":id", $_SESSION["user1_id"]);
        $return = [];
        if($conn->execute()){
            $selected = $conn->fetchAll();
            foreach($selected as $select){
                $return[] = [
                    $select["name"]
                ];
            }
        }
        return $return;
    }

    public function getAdmissionById(int $id){
        $conn = $this->db->prepare("SELECT user_id, message FROM projetadmission WHERE projet_id = :id");
        $conn->bindValue(":id", $id);
        if($conn->execute()){
            $return =  $conn->fetch();
            return [
                "userid" => $return["user_id"],
                "message" => $return["message"]
            ];
        }
    }

    public function acceptProject(int $id){
        $conn = $this->db->prepare("UPDATE projetadmission SET statue = 1 WHERE projetadmission.projet_id = :id");
        $conn->bindValue(":id", $id);
        $conn->execute();
    }

    public function refuseProject(int $id){
        $conn = $this->db->prepare("DELETE FROM projet WHERE id= :id");
        $conn->bindValue(":id", $id);
        $conn->execute();
    }
}