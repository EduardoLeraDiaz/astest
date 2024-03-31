<?php

namespace App\Domain\Common\Exception;

class DomainException extends \Exception
{
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}