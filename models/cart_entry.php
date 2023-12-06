<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "cart_entries")]
class CartEntry{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "users")]
    #[ORM\Column(type: 'integer')]
    private int $userId;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "events")]
    #[ORM\Column(type: 'integer')]
    private int $eventId;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'datetime')]
    private DateTime $created_at;

    #[ORM\Column(type: 'boolean')]
    private bool $expired = false;
    /**
     * @param int $userId
     * @param int $eventId
     * @param string $quantity
     */
    public function __construct(int $userId, int $eventId, int $quantity)
    {
        $this->userId = $userId;
        $this->eventId = $eventId;
        $this->quantity = $quantity;
        $this->created_at = new DateTime('now', new DateTimeZone('UTC'));
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

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
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

    public function isExpired(): bool
    {
        return $this->expired;
    }

    public function setExpired(bool $expired): void
    {
        $this->expired = $expired;
    }


}