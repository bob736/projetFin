<?php

namespace App\Traits;

trait Entity
{
    private ?int $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): Entity
    {
        $this->id = $id;
        return $this;
    }


}