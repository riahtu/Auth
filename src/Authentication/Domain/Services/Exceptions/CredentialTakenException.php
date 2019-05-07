<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class CredentialTakenException extends DomainException
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'Credential taken';
        parent::__construct(JsonResponse::HTTP_CONFLICT , $return);
    }
}
