<?php


namespace App\Manager;

use App\Traits\GlobalManager;
use App\Entity\Projet;
use App\Manager\UserManager;

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
}