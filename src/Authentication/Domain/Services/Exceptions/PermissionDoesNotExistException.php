<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class PermissionDoesNotExistException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'Permission does not exist';
        parent::__construct(JsonResponse::HTTP_CONFLICT , $return);
    }
}
