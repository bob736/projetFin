<?php

namespace App\Manager;

use App\Traits\Manager;
use App\Entity\PrivateMessage;

class PrivateMessageManager
{
    use Manager;

    public function getMessage(int $user2): array{
        $conn = $this->db->prepare("SELECT * FROM user INNER JOIN privatemessage ON user1_id = :user1 AND user2_id = :user2");
        $conn->bindValue(":user1", 1);
        $conn->bindValue("user2", 2);
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