<?php


namespace App\Entity;

use App\Traits\Entity;

class Channel
{
    use Entity;

    private ?int $id;
    private ?string $name;
    private ?array $messages;

    /**
     * Channel constructor.
     * @param int|null $id
     * @param string|null $name
     * @param array|null $messages
     */
    public function __construct(int $id = null, string $name = null, array $messages= null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->messages = $messages;
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
    public function setId(?int $id): Channel
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
    public function setName(?string $name): Channel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getMessages(): ?array
    {
        return $this->messages;
    }

    /**
     * @param array|null $messages
     */
    public function setMessages(?array $messages): Channel
    {
        $this->messages = $messages;
        return $this;
    }




}