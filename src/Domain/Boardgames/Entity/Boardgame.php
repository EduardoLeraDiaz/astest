<?php

namespace App\Domain\Boardgames\Entity;

class Boardgame
{
    public function __construct(
        readonly int    $bggId,
        readonly string $name,
        readonly string $description
    )
    {
    }
}