<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class RequestedDataNotValidException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'Requested data is not valid';
        parent::__construct(JsonResponse::HTTP_CONFLICT , $return);
    }

}
