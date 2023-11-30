<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "role_changes")]
class Role_changes{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "users")]
    #[ORM\Column(type: 'integer')]
    private int $adminId;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "users")]
    #[ORM\Column(type: 'integer')]
    private int $userId;

    #[ORM\Column(type: 'string')]
    private string $action;

    #[ORM\Column(type: 'datetime')]
    private DateTime $timestamp;

    /**
     * @param int $adminId
     * @param int $userId
     * @param string $action
     */
    public function __construct(int $adminId, int $userId, string $action)
    {
        $this->adminId = $adminId;
        $this->userId = $userId;
        $this->action = $action;
    }

    public function getAdminId(): int
    {
        return $this->adminId;
    }

    public function setAdminId(int $adminId): void
    {
        $this->adminId = $adminId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

    public function setTimestamp(DateTime $timestamp): void
    {
        $this->timestamp = $timestamp;
    }




}