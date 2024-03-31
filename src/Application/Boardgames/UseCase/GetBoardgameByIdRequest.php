<?php

namespace App\Application\Boardgames\UseCase;

readonly class GetBoardgameByIdRequest
{
    public function __construct(
        public int $id,
    )
    {
    }
}