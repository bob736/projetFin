<?php



namespace App\Manager;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Traits\GlobalManager;
use App\Manager\UserManager;
use App\Entity\User;
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
                if($message->getUserId() === $_SESSION["user1_id"]){
                    $message
                        ->setSent(true);
                }
                else{
                    $message
                        ->setSent(false);
                }
                $messages[] = $message;
            }
            return $messages;
        }
        return false;
    }

    public function sendMessage(string $message, int $channel){
        $conn = $this->db->prepare("INSERT INTO message (message, date, user_id) VALUES (:message, :date, :user_id)");
        $conn->bindValue(":message", sanitize($message));
        $conn->bindValue(":date", date('l jS \of F Y h:i:s A'));
        $conn->bindValue(":user_id", $_SESSION["user1_id"]);
        $conn->execute();

        $id = $this->db->lastInsertId();
        $conn = $this->db->prepare("INSERT INTO channelmessages (channel_id, message_id) VALUES (:chanid, :messid)");
        $conn->bindValue(":chanid", sanitize($channel));
        $conn->bindValue(":messid", $id);
        $conn->execute();
    }

    public function getUsers(int $id){
        $conn = $this->db->prepare("SELECT * FROM projetuser INNER JOIN user ON projetuser.user_id = user.id WHERE projetuser.projet_id = :id");
        $conn->bindValue(":id", $id);
        if($conn->execute()){
            $users = [];
            $selected = $conn->fetchAll();
            foreach($selected as $select){
                $user = new User();
                $user
                    ->setId($select["user_id"])
                    ->setName($select["name"])
                    ->setMail($select["mail"])
                    ->setBio($select["bio"]);
                $users[] = $user;
            }
            return $users;
        }
    }

    public function addChannel(int $id , string $name){
        $conn = $this->db->prepare("INSERT INTO channel (name, projet_id) VALUES (:name, :id)");
        $conn->bindValue(":name", $name);
        $conn->bindValue(":id", $id);
        $conn->execute();
    }

    public function getChannels(int $id){
        $conn = $this->db->prepare("SELECT * FROM channel WHERE projet_id = :id");
        $conn->bindValue(":id", $id);
        if($conn->execute()){
            $selected = $conn->fetchAll();
            return $selected;
        }
    }
}