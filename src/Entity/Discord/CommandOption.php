<?php

namespace App\Entity\Discord;

class CommandOption
{
    const SUB_COMMAND = 1;
    const SUB_COMMAND_GROUP = 2;
    const STRING = 3;
    /**
     *    Any integer between -2^53 and 2^53
     */
    const INTEGER = 4;
    const BOOLEAN = 5;
    const USER = 6;
    /**
     * Includes all channel types + categories
     */
    const CHANNEL = 7;
    const ROLE = 8;
    /**
     * Includes users and roles
     */
    const MENTIONABLE = 9;
    /**
     * Any double between -2^53 and 2^53
     */
    const NUMBER = 10;
    /**
     * attachment object
     */
    const ATTACHMENT = 11;
    /**
     * one of application CommandOption::type    the type of option
     */
    private int $type;
    /**
     * @var string    string    1-32 character name
     */
    private string $name;
    /**
     * @var string    string    1-100 character description
     */
    private string $description;
    /**
     * @var bool boolean    if the parameter is required or optional--default false
     */
    private bool $required = false;
    /**
     * @var array of application command option choice    choices for CommandOption::STRING, CommandOption::INTEGER, and CommandOption::NUMBER types for the user to pick from, max 25
     */
    private array $choices = [];
    /**
     * @var array of application command option    if the option is a subcommand or subcommand group type, these nested options will be the parameters
     */
    private array $options = [];
    /**
     * @var array of channel types    if the option is a channel type, the channels shown will be restricted to these types
     */
    private array $channel_types = [];
    /**
     * @var integer for INTEGER options, double for CommandOption::NUMBER options    if the option is an CommandOption::INTEGER or CommandOption::NUMBER type, the minimum value permitted
     */
    private int $min_value = 0;
    /**
     * @var integer for INTEGER options, double for CommandOption::NUMBER options    if the option is an CommandOption::INTEGER or CommandOption::NUMBER type, the maximum value permitted
     */
    private int $max_value = 0;
    /**
     * @var bool if autocomplete interactions are enabled for this CommandOption::STRING, CommandOption::INTEGER, or CommandOption::NUMBER type option
     */
    private bool $autocomplete = false;

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
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    /**
     * @return array
     */
    public function getChoices(): array
    {
        return $this->choices;
    }

    /**
     * @param array $choices
     */
    public function setChoices(array $choices): void
    {
        $this->choices = $choices;
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
     * @return array
     */
    public function getChannelTypes(): array
    {
        return $this->channel_types;
    }

    /**
     * @param array $channel_types
     */
    public function setChannelTypes(array $channel_types): void
    {
        $this->channel_types = $channel_types;
    }

    /**
     * @return int
     */
    public function getMinValue(): int
    {
        return $this->min_value;
    }

    /**
     * @param int $min_value
     */
    public function setMinValue(int $min_value): void
    {
        $this->min_value = $min_value;
    }

    /**
     * @return int
     */
    public function getMaxValue(): int
    {
        return $this->max_value;
    }

    /**
     * @param int $max_value
     */
    public function setMaxValue(int $max_value): void
    {
        $this->max_value = $max_value;
    }

    /**
     * @return bool
     */
    public function isAutocomplete(): bool
    {
        return $this->autocomplete;
    }

    /**
     * @param bool $autocomplete
     */
    public function setAutocomplete(bool $autocomplete): void
    {
        $this->autocomplete = $autocomplete;
    }
}
