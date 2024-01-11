<?php
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity]
#[ORM\Table(name: "visitors")]
class Visitor{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private string $IP;

    #[ORM\Column(type: 'integer')]
    private int $visits;

    /**
     * @param string $IP
     * @param int $visits
     */
    public function __construct(string $IP, int $visits)
    {
        $this->IP = $IP;
        $this->visits = $visits;
    }

    public function getIP(): string
    {
        return $this->IP;
    }

    public function setIP(string $IP): void
    {
        $this->IP = $IP;
    }

    public function getVisits(): int
    {
        return $this->visits;
    }

    public function setVisits(int $visits): void
    {
        $this->visits = $visits;
    }

}