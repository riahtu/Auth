<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class RoleAlreadyExistsException extends DomainException implements DomainExceptionInterface
{

    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'Role already exists';
        parent::__construct(JsonResponse::HTTP_CONFLICT , $return);
    }
}
