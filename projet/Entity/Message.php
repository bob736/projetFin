<?php


class Message
{
    private ?int $idUser1;
    private ?int $idUser2;
    private ?string $text;

     /**
     * Message constructor.
     * @param int|null $idUser1
     * @param int|null $idUser2
     * @param string|null $text
     */
    public function __construct(int $idUser1 = null, int $idUser2 = null, string $text = null)
    {
        $this->idUser1 = $idUser1;
        $this->idUser2 = $idUser2;
        $this->text = $text;
    }

    /**
     * @return int|null
     */
    public function getIdUser1(): ?int
    {
        return $this->idUser1;
    }

    /**
     * @param int|null $idUser1
     * @return $this
     */
    public function setIdUser1(?int $idUser1): Message
    {
        $this->idUser1 = $idUser1;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdUser2(): ?int
    {
        return $this->idUser2;
    }

    /**
     * @param int|null $idUser2
     * @return $this
     */
    public function setIdUser2(?int $idUser2): Message
    {
        $this->idUser2 = $idUser2;
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
     * @return $this
     */
    public function setText(?string $text): Message
    {
        $this->text = $text;
        return $this;
    }
}