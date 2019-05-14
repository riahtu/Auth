<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class RoleDoesNotExistException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['error'] = 'Role does not exist';
        $return['resource'] = $array;
        parent::__construct(JsonResponse::HTTP_CONFLICT, $return);
    }
}
