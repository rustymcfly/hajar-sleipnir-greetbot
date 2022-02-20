<?php

namespace App\Entity\Discord;

class CommandOptionChoice
{
    /**
     * @var string 1-100 character choice name
     */
    private string $name;
    /**
     * @var	string, integer, or double * value of the choice, up to 100 characters if string
     */
    private string $value;

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


}
