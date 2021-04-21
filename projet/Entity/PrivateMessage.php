<?php

namespace App\Entity;

use App\Traits\Entity;

class PrivateMessage
{
    use Entity;

    private ?int $user1_id;
    private ?int $user2_id;
    private ?string $text;
    private ?string $date;

    /**
     * PrivateMessageAll constructor.
     * @param int|null $id
     * @param int|null $user1_id
     * @param int|null $user2_id
     * @param string|null $text
     * @param string|null $date
     */
    public function __construct(int $id = null, int $user1_id = null, int $user2_id = null, string $text = null, string $date = null)
    {
        $this->id = $id;
        $this->user1_id = $user1_id;
        $this->user2_id = $user2_id;
        $this->text = $text;
        $this->date = $date;
    }
//
    /**
     * @return int|null
     */
    public function getUser1Id(): ?int
    {
        return $this->user1_id;
    }

    /**
     * @param int|null $user1_id
     */
    public function setUser1Id(?int $user1_id): PrivateMessage
    {
        $this->user1_id = $user1_id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getUser2Id(): ?int
    {
        return $this->user2_id;
    }

    /**
     * @param int|null $user2_id
     */
    public function setUser2Id(?int $user2_id): PrivateMessage
    {
        $this->user2_id = $user2_id;
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