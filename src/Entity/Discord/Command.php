<?php

namespace App\Entity\Discord;

class Command
{
    /**
     * @desc Slash commands; a text-based command that shows up when a user types /
     * @var int
     */
    const CHAT_INPUT_TYPE = 1;
    /**
     * @desc A UI-based command that shows up when you right click or tap on a user
     * @var int
     */
    const USER_TYPE = 2;
    /**
     * @desc A UI-based command that shows up when you right click or tap on a message
     * @var int
     */
    const MESSAGE = 3;
    /**
     * @var Snowflake unique id of the command all
     */
    private string $id;
    /**
     * @var int(1, 2, 3) one of application command type the type of command, defaults 1 if not set
     */
    private int $type = 1;

    /**
     * @see Snowflake
     * @var string  unique id of the parent application
     */
    private string $application_id;
    /**
     * @see Snowflake
     * @var string  guild id of the command, if not global
     */
    private string $guild_id;
    /**
     * @var string 1-32 character name
     */
    private string $name;
    /**
     * @var string 1-100 character description for CHAT_INPUT commands, empty string for USER and MESSAGE commands
     */
    private string $description;
    /**
     * @var array   of application command option    the parameters for the command, max 25. Only for Command::CHAT_INPUT_TYPE
     */
    private array $options = [];
    /**
     * @var bool whether the command is enabled by default when the app is added to a guild
     */
    private bool $default_permission = true;
    /**
     * @see Snowflake
     * @var string  autoincrementing version identifier updated during substantial record changes
     */
    private string $version;

    /**
     * @return Snowflake
     */
    public function getId(): Snowflake
    {
        return $this->id;
    }

    /**
     * @param Snowflake $id
     */
    public function setId(Snowflake $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return Snowflake
     */
    public function getApplicationId(): Snowflake
    {
        return $this->application_id;
    }

    /**
     * @param Snowflake $application_id
     */
    public function setApplicationId(Snowflake $application_id): void
    {
        $this->application_id = $application_id;
    }

    /**
     * @return Snowflake
     */
    public function getGuildId(): Snowflake
    {
        return $this->guild_id;
    }

    /**
     * @param Snowflake $guild_id
     */
    public function setGuildId(Snowflake $guild_id): void
    {
        $this->guild_id = $guild_id;
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * @return bool
     */
    public function isDefaultPermission(): bool
    {
        return $this->default_permission;
    }

    /**
     * @param bool $default_permission
     */
    public function setDefaultPermission(bool $default_permission): void
    {
        $this->default_permission = $default_permission;
    }

    /**
     * @return Snowflake
     */
    public function getVersion(): Snowflake
    {
        return $this->version;
    }

    /**
     * @param Snowflake $version
     */
    public function setVersion(Snowflake $version): void
    {
        $this->version = $version;
    }
}
