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
    private ?int $stat;
    private ?string $linkVerif;
    private ?string $lastLink;

    /**
     * Projet constructor.
     * @param array|null $users
     * @param int|null $id
     * @param string|null $name
     * @param string|null $link
     */
    public function __construct(array $users = null, int $id = null, string $name = null, string $link = null, array $channels = null, int $stat = null)
    {
        $this->users = $users;
        $this->id = $id;
        $this->name = $name;
        $this->link = $link;
        $this->channels = $channels;
        $this->stat = $stat;
    }

    /**
     * @return string|null
     */
    public function getLastLink(): ?string
    {
        return $this->lastLink;
    }

    /**
     * @param string|null $lastLink
     */
    public function setLastLink(?string $lastLink): Projet
    {
        $this->lastLink = $lastLink;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLinkVerif(): ?string
    {
        return $this->linkVerif;
    }

    /**
     * @param string|null $linkVerif
     */
    public function setLinkVerif(?string $linkVerif): Projet
    {
        $this->linkVerif = $linkVerif;
        return $this;
    }



    /**
     * @return int|null
     */
    public function getStat(): ?int
    {
        return $this->stat;
    }

    /**
     * @param int|null $stat
     * @return $this
     */
    public function setStat(?int $stat): Projet
    {
        $this->stat = $stat;
        return $this;
    }




    /**
     * @return array|null
     */
    public function getChannels(): ?array{
        return $this->channels;
    }

    /**
     * @param array $channels
     * @return $this
     */
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