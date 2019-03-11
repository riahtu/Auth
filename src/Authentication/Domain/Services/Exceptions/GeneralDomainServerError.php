<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 25-Feb-19
 * Time: 20:22
 */

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class GeneralDomainServerError extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['message'] = 'Something went wrong. Notify someone... or scream for help';
        parent::__construct(Response::HTTP_INTERNAL_SERVER_ERROR , $return);
    }
}
