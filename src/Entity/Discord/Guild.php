<?php

namespace App\Entity\Discord;

use App\Entity\User;
use App\Repository\GuildRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=GuildRepository::class)
 */
class Guild
{
    /**
     * @ORM\Id
     * @see Snowflake
     * @ORM\Column(type="string")
     */
    private string $id;
    /**
     * @ORM\Column(type="string", options={"default" : ""})
     */
    private string $name;

    /**
     * Many Groups have Many Users.
     * @ORM\OneToMany(targetEntity="App\Entity\ApplicationCommand", mappedBy="guild")
     */
    private Collection $commands;
    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="guilds")
     */
    private Collection $members;

    /**
     * https://cdn.discordapp.com/avatars/$splash.$extension?size=$size
     * @ORM\Column(type="string")
     */
    private string $icon;
    /**
     * @ORM\Column(type="string")
     */
    private string $description;
    /**
     * https://cdn.discordapp.com/avatars/$splash.$extension?size=$size
     * @ORM\Column(type="string")
     */
    private string $splash;
    /**
     * discovery splash hash; only present for guilds with the "DISCOVERABLE" feature
     * https://cdn.discordapp.com/avatars/$splash.$extension?size=$size
     * @ORM\Column(type="string")
     */
    private string $discovery_splash;
    /**
     * @var string[]
     * @see Feature
     * @ORM\Column(type="simple_array")
     */
    private array $features;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Discord\Emoji")
     * @ORM\JoinTable(name="guild_emojis",
     * joinColumns={@JoinColumn(name="guild_id", referencedColumnName="id")},
     * inverseJoinColumns={@JoinColumn(name="emoji_id", referencedColumnName="id")}
     * )
     */
    private Emoji $emojis;
    /**
     * https://discord.com/developers/docs/reference#image-formatting
     * @ORM\Column(type="string")
     */
    private string $banner;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="owns")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private User $owner_id;
    /**
     * @ORM\Column(type="string")
     */
    private string $application_id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discord\Channel", inversedBy="id")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private Channel $afk_channel_id;
    /**
     * @ORM\Column(type="integer")
     */
    private int $afk_timeout;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discord\Channel", inversedBy="id")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private Channel $system_channel_id;
    /**
     * @ORM\Column(type="boolean", options="{default: true}")
     */
    private bool $widget_enabled;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discord\Channel", inversedBy="id")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private Channel $widget_channel_id;
    /**
     * @var int
     * @see VerificationLevel
     * @ORM\Column(type="integer")
     */
    private int $verification_level;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Discord\Role")
     * @ORM\JoinTable(name="guild_roles",
     * joinColumns={@JoinColumn(name="guild_id", referencedColumnName="id")},
     * inverseJoinColumns={@JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    private Collection $roles;
    /**
     * default message notifications level
     * @var int
     * @see NotificationLevel
     * @ORM\Column(type="integer")
     */
    private int $default_message_notifications;
    /**
     * required MFA level for the guild
     * @var int
     * @see MfaLevel
     * @ORM\Column(type="integer")
     */
    private int $mfa_level;
    /**
     * @var int
     * @see ExplicitContentFilter
     * @ORM\Column(type="integer")
     */
    private int $explicit_content_filter;
    /**
     * the maximum number of presences for the guild (null is always returned, apart from the largest of guilds)
     * @ORM\Column(type="integer")
     */
    private int $max_presences;
    /**
     * the maximum number of members for the guild
     * @ORM\Column(type="integer")
     */
    private int $max_members;
    /**
     * the vanity url code for the guild
     * @ORM\Column(type="string")
     */
    private string $vanity_url_code;
    /**
     * @var int
     * @see PremiumTier
     * @ORM\Column(type="integer")
     */
    private int $premium_tier;
    /**
     * the number of boosts this guild currently has
     * @ORM\Column(type="integer")
     */
    private int $premium_subscription_count;
    /**
     *
     * @var int
     * @see SystemChannelFlag
     * @ORM\Column(type="integer")
     */
    private int $system_channel_flags;
    /**
     * the preferred locale of a Community guild; used in server discovery and notices from Discord, and sent in interactions; defaults to "en-US"
     * @ORM\Column(type="string")
     */
    private string $preferred_locale;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discord\Channel", inversedBy="id")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private Channel $rules_channel_id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discord\Channel", inversedBy="id")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private Channel $public_updates_channel_id;
    /**
     * @ORM\Column(type="string")
     */
    private string $permissions;

    #[Pure] public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->commands = new ArrayCollection();
        $this->name = "";
    }

    /**
     * @return Collection
     */
    public function getCommands(): Collection
    {
        return $this->commands;
    }

    /**
     * @param Collection $commands
     */
    public function setCommands($commands): void
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
     * @return Collection
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    /**
     * @param Collection $members
     */
    public function setMembers(Collection $members): void
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

    /**
     * @return string
     */
    public function getPermissions(): string
    {
        return $this->permissions;
    }

    /**
     * @param string $permissions
     */
    public function setPermissions(string $permissions): void
    {
        $this->permissions = $permissions;
    }
}
