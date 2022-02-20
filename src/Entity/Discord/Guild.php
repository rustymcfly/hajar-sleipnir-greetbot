<?php

namespace App\Entity\Discord;

use App\Repository\GuildRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GuildRepository::class)
 */
class Guild
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;
    /**
     * @ORM\Column(type="string")
     */
    private string $name;
    /**
     * @ORM\Column(type="string")
     */
    private string $guild_id;

    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="App\Entity\ApplicationCommand", mappedBy="guilds")
     */
    private ArrayCollection $commands;
    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="guilds")
     */
    private ArrayCollection $members;


    public function __construct() {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commands = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return array
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    /**
     * @param array $commands
     */
    public function setCommands(array $commands): void
    {
        $this->commands = $commands;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * @param array $members
     */
    public function setMembers(array $members): void
    {
        $this->members = $members;
    }

    /**
     * @return string
     */
    public function getGuildId(): string
    {
        return $this->guild_id;
    }

    /**
     * @param string $guild_id
     */
    public function setGuildId(string $guild_id): void
    {
        $this->guild_id = $guild_id;
    }
}
