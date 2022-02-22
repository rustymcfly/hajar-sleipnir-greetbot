<?php

namespace App\Entity\Discord;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EmojiRepository;
/**
 * @ORM\Entity(repositoryClass=EmojiRepository::class)
 */
class Emoji
{
    /**
     * @var string  emoji id [optional]
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private string $id;

    /**
     * @var string  (can be null only in reaction emoji objects)    emoji name [optional]
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @var Role[] array of role object ids    roles allowed to use this emoji [optional]
     * @ORM\ManyToOne(targetEntity="App\Entity\Discord\Role", inversedBy="id")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private array $roles;

    /**
     * @var User    user that created this emoji [optional]
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="id")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private User $user;

    /**
     * @var bool  whether this emoji must be wrapped in colons [optional]
     * @ORM\Column(type="boolean")
     */
    private bool $require_colons;

    /**
     * @var bool whether this emoji is managed [optional]
     * @ORM\Column(type="boolean")
     */
    private bool $managed;

    /**
     * @var bool whether this emoji is animated [optional]
     * @ORM\Column(type="boolean")
     */
    private bool $animated;

    /**
     * @var bool  whether this emoji can be used, may be false due to loss of Server Boosts [optional]
     * @ORM\Column(type="boolean")
     */
    private bool $available;
}
