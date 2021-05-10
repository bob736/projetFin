<?php


namespace App\Entity;

use App\Traits\Entity;

class Projet
{
    use Entity;

    private ?array $users;
    private ?int $id;
    private ?string $name;
    private ?string $link;
    private ?array $channels;

    /**
     * Projet constructor.
     * @param array|null $users
     * @param int|null $id
     * @param string|null $name
     * @param string|null $link
     */
    public function __construct(array $users = null, int $id = null, string $name = null, string $link = null, array $channels = null)
    {
        $this->users = $users;
        $this->id = $id;
        $this->name = $name;
        $this->link = $link;
        $this->channels = $channels;
    }

    public function getChannels(): ?array{
        return $this->channels;
    }

    public function setChannels(array $channels): Projet{
        $this->channels = $channels;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getUsers(): ?array
    {
        return $this->users;
    }

    /**
     * @param array|null $users
     * @return $this
     */
    public function setUsers(?array $users): Projet
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return $this
     */
    public function setId(?int $id): Projet
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): Projet
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     * @return $this
     */
    public function setLink(?string $link): Projet
    {
        $this->link = $link;
        return $this;
    }

}