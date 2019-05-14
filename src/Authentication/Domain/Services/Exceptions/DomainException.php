<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpKernel\Exception\HttpException;

class DomainException extends HttpException
{
    /**
     * @var array
     */
    private $array;

    public function __construct($statusCode, array $array , $apiMessage = null)
    {
        parent::__construct($statusCode, $apiMessage);
        $this->array = $array;
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->array;
    }
}
