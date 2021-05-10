<?php


namespace App\Manager;

use App\Traits\GlobalManager;
use App\Manager\UserManager;
use App\Entity\Message;

class ChannelManager
{
    use GlobalManager;

    public function getMessageByChannelId(int $id){
        $conn = $this->db->prepare("SELECT * FROM message INNER JOIN channelmessages ON message.id = channelmessages.message_id INNER JOIN channel ON channel.id = channelmessages.channel_id WHERE channel.id = :id");
        $conn->bindValue(":id", $id);
        if($conn->execute()){
            $selected = $conn->fetchAll();
            $messages = [];
            $userManager = new UserManager();
            foreach($selected as $select){
                $message = new Message();
                $user = $userManager->getUsernameById($select["user_id"]);
                $message
                    ->setUserId($select["user_id"])
                    ->setId($select["id"])
                    ->setUsername($user["name"])
                    ->setDate($select["date"])
                    ->setText($select["message"])
                    ->setId($select["message_id"]);
                $messages[] = $message;
            }
            return $messages;
        }
        return false;
    }
}