<?php

namespace App\Manager;

use App\Traits\Manager;
use App\Entity\PrivateMessage;

session_start();

class PrivateMessageManager
{
    use Manager;

    public function getMessage(int $user2): array{
        $conn = $this->db->prepare("SELECT p.id, p.message, p.date, u1.name, u1.id as user_1, u2.name as user_2 FROM privatemessage as p INNER JOIN user as u1 ON p.user1_id = u1.id INNER JOIN user as u2 ON p.user2_id = u2.id WHERE ((u1.id IN (:id1, :id2) ) AND (u2.id IN (:id1, :id2)))");
        $conn->bindValue(":id1", $_SESSION["user1_id"]);
        $conn->bindValue(":id2", $user2);
        $conn->execute();
        $messages = [];
        foreach($conn->fetchAll() as $select){
            $message = new PrivateMessage();
            if(intval($select["user_1"]) === intval($_SESSION["user1_id"])){
                $message
                    ->setSent(true);
            }
            $message
                ->setText($select["message"])
                ->setDate($select["date"])
                ->setUsername($select["name"]);
            $messages[] = $message;
        }
        return $messages;
    }
}