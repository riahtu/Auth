<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 13-Jan-19
 * Time: 20:44
 */

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class RoleAlreadyExistsException extends DomainException implements DomainExceptionInterface
{

    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['message'] = 'Role already exists';
        parent::__construct(Response::HTTP_CONFLICT , $return);
    }
}
