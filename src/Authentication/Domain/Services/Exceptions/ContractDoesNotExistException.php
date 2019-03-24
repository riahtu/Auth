<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 17-Jan-19
 * Time: 11:17
 */

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class ContractDoesNotExistException extends DomainException
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'Contract can not be found';
        parent::__construct(Response::HTTP_CONFLICT , $return);
    }
}
