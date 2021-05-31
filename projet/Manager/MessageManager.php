<?php

namespace App\Manager;
use App\Traits\GlobalManager;

class MessageManager

{
    use GlobalManager;

    /**
     * Insert a message in database
     * @param Message $message
     */
    public function sendMessage(Message $message){
        $conn = $this->db->prepare("INSERT INTO privatemessage (user1_id, user2_id, message) VALUES (:user1, :user2, :message)");
        $conn->bindValue(":user1", $message->getIdUser1());
        $conn->bindValue(":user2", $message->getIdUser2());
        $conn->bindValue(":message", $message->getText());
        $conn->execute();
    }
}