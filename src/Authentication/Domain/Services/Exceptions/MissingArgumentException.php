<?php


namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\JsonResponse;

class MissingArgumentException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return = [
            'error' => 'An argument is missing from the request',
            'resource' => $array
        ];
        parent::__construct(JsonResponse::HTTP_BAD_REQUEST , $return);
    }
}
