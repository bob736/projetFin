<?php

namespace App\Entity;

use App\Traits\Entity;

class User
{
    use Entity;

    private ?string $name;
    private ?string $pass;
    private ?string $mail;
    private ?string $lien;
    private ?string $icon;
    private ?string $bio;
    private ?string $role;

    /**
     * User constructor.
     * @param int|null $id
     * @param string|null $name
     * @param string|null $pass
     * @param string|null $mail
     */
    public function __construct(int $id = null, string $name= null, string $pass= null, string $mail= null, string $lien = null, string $icon = null, string $bio = null, string $role = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->pass = $pass;
        $this->mail = $mail;
        $this->lien = $lien;
        $this->icon = $icon;
        $this->bio = $bio;
        $this->role = $role;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string|null $role
     */
    public function setRole(?string $role): User
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBio(): ?string
    {
        return $this->bio;
    }

    /**
     * @param string|null $bio
     */
    public function setBio(?string $bio): User
    {
        $this->bio = $bio;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     */
    public function setIcon(?string $icon): User
    {
        $this->icon = $icon;
        return $this;
    }



    /**
     * @return string|null
     */
    public function getLien(): ?string
    {
        return $this->lien;
    }

    /**
     * @param string|null $lien
     */
    public function setLien(?string $lien): User
    {
        $this->lien = $lien;
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
     */
    public function setName(?string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPass(): ?string
    {
        return $this->pass;
    }

    /**
     * @param string|null $pass
     */
    public function setPass(?string $pass): User
    {
        $this->pass = $pass;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * @param string|null $mail
     */
    public function setMail(?string $mail): User
    {
        $this->mail = $mail;
        return $this;
    }




}