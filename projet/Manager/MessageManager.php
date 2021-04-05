<?php


class MessageManager
{
    private ?PDO $db;

    /**
     * ArticleManager constructor.
     */
    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function sendMessage(Message $message){
        $conn = $this->db->prepare("INSERT INTO privateMessage (user1_id, user2_id, message) VALUES (:user1, :user2, :message)");
        $conn->bindValue(":user1", $message->getIdUser1());
        $conn->bindValue(":user2", $message->getIdUser2());
        $conn->bindValue(":message", $message->getText());
        $conn->execute();
    }
}