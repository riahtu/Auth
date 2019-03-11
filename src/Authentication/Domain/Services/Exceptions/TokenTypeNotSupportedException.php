<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 23-Feb-19
 * Time: 12:09
 */

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class TokenTypeNotSupportedException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['message'] = 'Requested token type does not exist';
        $return['resource'] = $array;
        parent::__construct(Response::HTTP_NOT_ACCEPTABLE, $return);
    }
}
