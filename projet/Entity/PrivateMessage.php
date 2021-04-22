<?php

namespace App\Entity;

use App\Traits\Entity;

class PrivateMessage
{
    use Entity;

    private ?int $userid;
    private ?string $username;
    private ?string $text;
    private ?string $date;
    private ?bool $sent;

    /**
     * PrivateMessage constructor.
     * @param int|null $id
     * @param int|null $user1_id
     * @param int|null $user2_id
     * @param string|null $text
     * @param string|null $date
     * @param string|null $user1_name
     * @param string|null $user2_name
     * @param bool|null $sent
     */
    public function __construct(int $id = null, int $userid = null, string $text = null, string $date = null, string $username = null, bool $sent = false)
    {
        $this->id = $id;
        $this->userid = $userid;
        $this->text = $text;
        $this->date = $date;
        $this->username = $username;
        $this->sent = $sent;
    }

    /**
     * @return bool|null
     */
    public function getSent(): ?bool
    {
        return $this->sent;
    }

    /**
     * @param bool|null $sent
     */
    public function setSent(?bool $sent): PrivateMessage
    {
        $this->sent = $sent;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->user1_name;
    }

    /**
     * @param string|null $user1_name
     */
    public function setUsername(?string $user1_name): PrivateMessage
    {
        $this->user1_name = $user1_name;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userid;
    }

    /**
     * @param int|null $userid
     * @return $this
     */
    public function setUserId(?int $userid): PrivateMessage
    {
        $this->userid = $userid;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     */
    public function setText(?string $text): PrivateMessage
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): PrivateMessage
    {
        $this->date = $date;
        return $this;
    }



}