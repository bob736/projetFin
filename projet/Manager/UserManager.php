<?php

class UserManager
{
    private ?PDO $db;

    /**
     * ArticleManager constructor.
     */
    public function __construct()
    {
        $this->db = DB::getInstance();
    }


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
                    ->setChannel(explode(",",$selected["channel"]));
                return $user;
            }
            else{
                return null;
            }
        }
    }

}