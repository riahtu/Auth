<?php

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class TokenGeneratorErrorException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['error'] = 'Something went wrong while generating your key';
        $return['resource'] = $array;
        parent::__construct(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $return);
    }
}
