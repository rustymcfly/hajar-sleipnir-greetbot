<?php

namespace App\Entity\Discord;

class Snowflake
{
    public function __construct($snowflake)
    {
        $this->snowflake = $snowflake;
    }

    private string $snowflake;

    public function __toString(): string
    {
        return $this->snowflake;
    }
}
