<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 25-Feb-19
 * Time: 19:28
 */

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class TokenGeneratorErrorException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['message'] = 'Something went wrong while generating your key';
        $return['resource'] = $array;
        parent::__construct(Response::HTTP_INTERNAL_SERVER_ERROR, $return);
    }
}
