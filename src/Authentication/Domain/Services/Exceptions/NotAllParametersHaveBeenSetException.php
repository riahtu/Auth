<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 09-Apr-19
 * Time: 17:54
 */

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class NotAllParametersHaveBeenSetException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['error'] = 'Not all needed parameters have been set!';
        parent::__construct(Response::HTTP_CONFLICT , $return);
    }
}
