<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 17-Jan-19
 * Time: 18:44
 */

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class PermissionDoesNotExistException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['resource'] = $array;
        $return['message'] = 'Permission does not exist';
        parent::__construct(Response::HTTP_CONFLICT , $return);
    }
}
