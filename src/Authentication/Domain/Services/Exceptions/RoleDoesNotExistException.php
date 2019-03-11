<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 13-Jan-19
 * Time: 16:26
 */

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class RoleDoesNotExistException extends DomainException implements DomainExceptionInterface
{
    public function __construct(array $array)
    {
        $return['message'] = 'Role does not exist';
        $return['resource'] = $array;
        parent::__construct(Response::HTTP_CONFLICT, $return);
    }
}
