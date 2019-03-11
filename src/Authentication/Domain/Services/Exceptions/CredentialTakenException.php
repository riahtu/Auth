<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 12-Jan-19
 * Time: 15:29
 */

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class CredentialTakenException extends DomainException
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['message'] = 'Credential taken';
        parent::__construct(Response::HTTP_CONFLICT , $return);
    }
}
