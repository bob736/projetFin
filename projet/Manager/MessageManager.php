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

    public function sendMessage(int $idUser1, int $idUser2){
        
    }
}