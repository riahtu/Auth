<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class InvalidClientToken extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'None existed or invalid token!';
        parent::__construct(JsonResponse::HTTP_CONFLICT , $return);
    }
}
