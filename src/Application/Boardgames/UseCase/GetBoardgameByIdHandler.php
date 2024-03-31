<?php

namespace App\Application\Boardgames\UseCase;

use App\Application\Boardgames\Transformer\bggXMLToBoardgameTransformer;
use App\Domain\Common\Exception\NotFoundException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GetBoardgameByIdHandler
{
    public function __construct(
        #[Autowire(service: 'bgg.client')]
        private HttpClientInterface $bggClient,
        private bggXMLToBoardgameTransformer $transformer,
    )
    {
    }

    /**
     * @throws NotFoundException
     * @throws TransportExceptionInterface
     */
    public function handle(GetBoardgameByIdRequest $request): GetBoardgameByIdResponse
    {
        throw new \Exception("fail");
        $response = $this->bggClient->request('GET', $request->id);

        try {
            $bodyContent = $response->getContent();
        } catch (\Throwable $e) {
            if ($response->getStatusCode() != 404) {
                throw $e;
            }
        }
        if (empty($bodyContent) || $response->getStatusCode() == 404) {
            throw new NotFoundException(sprintf("boardgame with id %s not found", $request->id));
        }

        $boardGame = $this->transformer->transform($bodyContent);


        return new GetBoardgameByIdResponse($boardGame);

    }
}