<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "events")]
class Event{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $type;

    #[ORM\Column(type: 'datetime')]
    private DateTime $date;

    #[ORM\Column(type: 'string')]
    private string $location;

    #[ORM\Column(type: 'integer')]
    private int $total_tickets;

    #[ORM\Column(type: 'integer')]
    private int $sold_tickets = 0;

    #[ORM\Column(type: 'decimal', precision: 7, scale: 2)]
    private float $price;

    #[ORM\Column(type: 'text')]
    private string $description;

    /**
     * @param string $name
     * @param string $type
     * @param DateTime $date
     * @param string $location
     * @param int $total_tickets
     * @param string $price
     * @param string $description
     */
    public function __construct(string $name, string $type, DateTime $date, string $location, int $total_tickets, string $price, string $description)
    {
        $this->name = $name;
        $this->type = $type;
        $this->date = $date;
        $this->location = $location;
        $this->total_tickets = $total_tickets;
        $this->price = $price;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getTotalTickets(): int
    {
        return $this->total_tickets;
    }

    public function setTotalTickets(int $total_tickets): void
    {
        $this->total_tickets = $total_tickets;
    }

    public function getSoldTickets(): string
    {
        return $this->sold_tickets;
    }

    public function setSoldTickets(string $sold_tickets): void
    {
        $this->sold_tickets = $sold_tickets;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }



}