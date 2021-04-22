<?php

namespace App\Manager;

use App\Traits\Manager;
use App\Entity\PrivateMessage;

session_start();

class PrivateMessageManager
{
    use Manager;

    public function getMessage(int $user2): array{
        $conn = $this->db->prepare("SELECT * FROM privatemessage WHERE user1_id = :user1 AND user2_id = :user2");
        $conn->bindValue(":user1", $_SESSION["user1_id"]);
        $conn->bindValue(":user2", $user2);
        $conn->execute();
        $messages = [];
        foreach($conn->fetchAll() as $select){
            $message = new PrivateMessage();
            $message
                ->setText($select["message"])
                ->setDate($select["date"]);
            $messages[] = $message;
        }
        return $messages;
    }
}