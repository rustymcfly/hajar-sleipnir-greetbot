<?php

namespace App\Entity\Discord;

class CommandOptionDataOption
{
    /**
     * @var string string    the name of the parameter
     */
    private string $name;
    /**
     * @var int integer    value of application command option type
     */
    private int $type;
    /**
     * @var string, integer, or double    the value of the option resulting from user input
     */
    private string $value = "";
    /**
     * @var array  of application command interaction data option    present if this option is a group or subcommand
     */
    private array $options = [];
    /**
     * @var bool boolean    true if this option is the currently focused option for autocomplete
     */
    private bool $focused = false;

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
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
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
    public function isFocused(): bool
    {
        return $this->focused;
    }

    /**
     * @param bool $focused
     */
    public function setFocused(bool $focused): void
    {
        $this->focused = $focused;
    }
}
