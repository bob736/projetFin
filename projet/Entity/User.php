<?php


class User
{
    private ?int $id;
    private ?string $name;
    private ?string $pass;
    private ?string $mail;
    private ?array $channel;

    /**
     * User constructor.
     * @param int|null $id
     * @param string|null $name
     * @param string|null $pass
     * @param string|null $mail
     */
    public function __construct(int $id = null, string $name= null, string $pass= null, string $mail= null, array $channel= null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->pass = $pass;
        $this->mail = $mail;
        $this->channel = $channel;
    }

    /**
     * @return array|null
     */
    public function getChannel(): ?array
    {
        return $this->channel;
    }

    /**
     * @param array|null $channel
     */
    public function setChannel(?array $channel): User
    {
        $this->channel = $channel;
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
     */
    public function setId(?int $id): User
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