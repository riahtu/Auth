<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class ContractDoesNotExistException extends DomainException
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'Contract can not be found';
        parent::__construct(JsonResponse::HTTP_CONFLICT , $return);
    }
}
