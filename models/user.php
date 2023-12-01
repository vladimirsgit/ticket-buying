<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $username;
    #[ORM\Column(type: 'string')]
    private string $lastname;

    #[ORM\Column(type: 'string')]
    private string $firstname;

    #[ORM\Column(type: 'string')]
    private string $email;

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'string')]
    private string $role = 'common';

    #[ORM\Column(type: 'datetime')]
    private DateTime $created;

    #[ORM\Column(type: 'string')]
    private string $email_token;

    #[ORM\Column(type: 'boolean')]
    private bool $confirmedEmail = false;

    #[ORM\Column(type: 'string')]
    private ?string $reset_password_token = '';

    /**
     * @param string $username
     * @param string $lastname
     * @param string $firstname
     * @param string $email
     * @param string $password
     * @param string $token
     */
    public function __construct(string $username = null, string $lastname = null, string $firstname = null, string $email = null, string $password = null, string $token = null)
    {
        $this->username = $username;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->password = $password;
        $this->email_token = $token;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }
    public function getEmailToken(): string
    {
        return $this->email_token;
    }

    public function setEmailToken(string $email_token): void
    {
        $this->email_token = $email_token;
    }

    public function isConfirmedEmail(): bool
    {
        return $this->confirmedEmail;
    }

    public function setConfirmedEmail(bool $confirmedEmail): void
    {
        $this->confirmedEmail = $confirmedEmail;
    }

    public function getResetPasswordtoken(): ?string
    {
        return $this->reset_password_token;
    }

    public function setResetPasswordtoken(string $reset_password_token): void
    {
        $this->reset_password_token = $reset_password_token;
    }



}