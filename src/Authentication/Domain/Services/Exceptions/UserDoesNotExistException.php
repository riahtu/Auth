<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class UserDoesNotExistException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['error'] = 'User does not exist';
        $return['resource'] = $array;
        parent::__construct(JsonResponse::HTTP_CONFLICT, $return);
    }
}
