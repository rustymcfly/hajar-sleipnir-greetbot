<?php

namespace App\Entity\Discord;

class Snowflake
{
    private string $snowflake;

    public function __toString(): string
    {
        return $this->snowflake;
    }
}
