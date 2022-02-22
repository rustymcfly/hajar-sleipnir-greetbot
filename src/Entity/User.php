<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;
    /**
     * @ORM\Column(type="string")
     */
    private string $oAuthToken;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Discord\Guild", inversedBy="members")
     * @ORM\JoinTable(name="guilds_members")
     */
    protected ArrayCollection $guilds;

    /**
     * One product has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="App\Entity\Discord\Guild", mappedBy="owner_id")
     */
    private ArrayCollection $owns;



    #[Pure] public function __construct() {
        $this->owns = new ArrayCollection();
        $this->guilds = new ArrayCollection();
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return string
     */
    public function getGuildMemberId(): string
    {
        return $this->guild_member_id;
    }

    /**
     * @param string $guild_member_id
     */
    public function setGuildMemberId(string $guild_member_id): void
    {
        $this->guild_member_id = $guild_member_id;
    }
    /**
     * @return ArrayCollection
     */
    public function getGuilds(): ArrayCollection
    {
        return $this->guilds;
    }

    /**
     * @param ArrayCollection $guilds
     */
    public function setGuilds(ArrayCollection $guilds): void
    {
        $this->guilds = $guilds;
    }

    /**
     * @return ArrayCollection
     */
    public function getOwns(): ArrayCollection
    {
        return $this->owns;
    }

    /**
     * @param ArrayCollection $owns
     */
    public function setOwns(ArrayCollection $owns): void
    {
        $this->owns = $owns;
    }

}
