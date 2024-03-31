<?php

namespace App\Application\Common\ExceptionListener;

use App\Domain\Common\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

readonly class HTTPExceptionListener
{
    public function __construct(public string $environment)
    {

    }

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if ($exception instanceof NotFoundException) {
            $event->setResponse(new JsonResponse(null, 404));
            return;
        }

        if ($this->environment == 'dev') {
            $event->setResponse(new jsonResponse([
                'message' => $exception->getMessage(),
                'code'    => $exception->getCode(),
                'traces'  => $exception->getTrace()
            ], 500));
            return;
        }

        $event->setResponse(new jsonResponse(null, 500));
    }
}