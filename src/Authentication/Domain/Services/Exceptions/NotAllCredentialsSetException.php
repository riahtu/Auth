<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class NotAllCredentialsSetException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['error'] = 'Not all credentials have been set!';
        parent::__construct(JsonResponse::HTTP_CONFLICT , $return);
    }
}
