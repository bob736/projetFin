<?php

namespace App\Manager;
use App\Traits\GlobalManager;
use App\Entity\User;

class UserManager
{
    use GlobalManager;

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

    public function getUsers(): array{
        $conn = $this->db->prepare("SELECT * FROM user");
        $users = [];
        if($conn->execute()){
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

    public function getUsernameById(int $id){
        $conn = $this->db->prepare("SELECT name FROM user WHERE id = :id");
        $conn->bindValue(":id", $id);
        if($conn->execute()){
            return $conn->fetch();
        }
    }

    public function getAllInfoById(int $id){
        $conn = $this->db->prepare("SELECT * FROM user WHERE id = :id");
        $conn->bindValue(":id", $id);
        if($conn->execute()){
            $user = new User();
            $info = $conn->fetch();
            $user
                ->setId($info["id"])
                ->setMail($info["mail"])
                ->setLien($info["lienGithub"])
                ->setName($info["name"])
                ->setPass($info["pass"])
                ->setIcon($info["icone"])
                ->setBio($info["bio"]);
            return $user;
        }
    }

    public function followUser(int $id){
        $conn = $this->db->prepare("SELECT id FROM userfollow WHERE user1_id = :id1 AND user2_id = :id2");
        $conn->bindValue(":id1", $_SESSION["user1_id"]);
        $conn->bindValue(":id2", $id);
        if($conn->execute()){
            if(!$conn->fetch()){
                $conn = $this->db->prepare("INSERT INTO userfollow (user1_id, user2_id)  VALUES (:id1, :id2)");
                $conn->bindValue(":id1", $_SESSION["user1_id"]);
                $conn->bindValue(":id2", $id);
                $conn->execute();
                return true;
            }
            else{
                $conn = $this->db->prepare("DELETE FROM userfollow WHERE user1_id = :id1 AND user2_id = :id2");
                $conn->bindValue(":id1", $_SESSION["user1_id"]);
                $conn->bindValue(":id2", $id);
                $conn->execute();
                return false;
            }
        }
    }

    public function getFollow($id){
        $conn = $this->db->prepare("SELECT id FROM userfollow WHERE user1_id = :id1 AND user2_id = :id2");
        $conn->bindValue(":id1", $_SESSION["user1_id"]);
        $conn->bindValue(":id2", $id);
        if($conn->execute()){
            if ($conn->fetch()) {
                return true;
            }
            else{
                return false;
            }
        }
    }
}