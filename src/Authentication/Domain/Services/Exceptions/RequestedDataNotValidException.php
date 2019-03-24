<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 23-Feb-19
 * Time: 14:34
 */

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class RequestedDataNotValidException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'Requested data is not valid';
        parent::__construct(Response::HTTP_CONFLICT , $return);
    }

}
