<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "cart")]
class Cart{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "users")]
    #[ORM\Column(type: 'integer')]
    private int $userId;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "events")]
    #[ORM\Column(type: 'integer')]
    private int $eventId;

    #[ORM\Column(type: 'integer')]
    private string $quantity;

    #[ORM\Column(type: 'datetime')]
    private DateTime $created_at;

    /**
     * @param int $userId
     * @param int $eventId
     * @param string $quantity
     */
    public function __construct(int $userId, int $eventId, string $quantity)
    {
        $this->userId = $userId;
        $this->eventId = $eventId;
        $this->quantity = $quantity;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getEventId(): int
    {
        return $this->eventId;
    }

    public function setEventId(int $eventId): void
    {
        $this->eventId = $eventId;
    }

    public function getQuantity(): string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }



}