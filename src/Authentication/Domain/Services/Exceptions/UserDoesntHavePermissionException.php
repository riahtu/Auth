<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class UserDoesntHavePermissionException extends DomainException implements DomainExceptionInterface
{

    public function __construct(array $array)
    {
        $return['error'] = 'User does not have permission!';
        $return['resource'] = $array;
        parent::__construct(JsonResponse::HTTP_UNAUTHORIZED, $return);
    }
}
