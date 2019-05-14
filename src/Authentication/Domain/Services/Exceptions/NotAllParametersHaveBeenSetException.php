<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class NotAllParametersHaveBeenSetException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'Not all needed parameters have been set!';
        parent::__construct(JsonResponse::HTTP_CONFLICT , $return);
    }
}
