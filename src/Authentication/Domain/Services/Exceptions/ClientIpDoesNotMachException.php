<?php


namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class ClientIpDoesNotMachException extends DomainException
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'Client IP does not match IP on record';
        parent::__construct(JsonResponse::HTTP_CONFLICT , $return);
    }
}
