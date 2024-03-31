<?php

namespace App\Application\Boardgames\UseCase;

use App\Domain\Boardgames\Entity\Boardgame;

readonly class GetBoardgameByIdResponse
{
    public function __construct(
        public Boardgame $boardgame,
    )
    {
    }
}