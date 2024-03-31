<?php

namespace App\Infrastructure\Boardgames\Http\Controller;

use App\Application\Boardgames\UseCase\GetBoardgameByIdHandler;
use App\Application\Boardgames\UseCase\GetBoardgameByIdRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetController extends AbstractController
{
    public function __construct(
        private GetBoardgameByIdHandler $getBoardgameByIdHandler
    )
    {
    }

    #[Route('/boardgames/{id}',
        name: 'boardgames-get',
        requirements: ['id' => '^[1-9]\d*$']
    )]
    public function get(int $id): Response
    {
        $response = $this->getBoardgameByIdHandler->handle(
            new GetBoardgameByIdRequest($id)
        );

        return new JsonResponse($response->boardgame);
    }
}