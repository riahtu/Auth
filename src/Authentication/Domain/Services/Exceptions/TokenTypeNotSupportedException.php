<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class TokenTypeNotSupportedException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['error'] = 'Requested token type does not exist';
        $return['resource'] = $array;
        parent::__construct(JsonResponse::HTTP_NOT_ACCEPTABLE, $return);
    }
}
