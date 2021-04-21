<?php

namespace App\Manager;
use App\Traits\Manager;
use App\Entity\User;

class UserManager
{
    use Manager;

    /**
     * Return the first User where mail = $mail
     * @param string $mail
     * @return User|null
     */
    public function getUserByMail(string $mail): ?User {
        $conn = $this->db->prepare("SELECT * FROM user WHERE mail = :mail");
        $conn->bindValue(":mail", $mail);
        if($conn->execute()){
            $selected = $conn->fetchAll();
            if(count($selected) > 0){
                $selected = $selected[0];
                $user = new User();
                $user
                    ->setId($selected["id"])
                    ->setMail($selected["mail"])
                    ->setPass($selected["pass"])
                    ->setName($selected["name"])
                    ->setLien($selected["lienGithub"]);
                return $user;
            }
            else{
                return null;
            }
        }
    }

    public function getUsers(): Array{
        $conn = $this->db->prepare("SELECT * FROM user");
        if($conn->execute()){
            $users = [];
            $selected = $conn->fetchAll();
            foreach($selected as $select){
                $user = new User();
                $user
                    ->setName($select["name"])
                    ->setId($select["id"])
                    ->setMail($select["mail"])
                    ->setLien($select["lienGithub"])
                    ->setPass($select["pass"]);
                $users[] = $user;
            }
        }
        return $users;
    }

}