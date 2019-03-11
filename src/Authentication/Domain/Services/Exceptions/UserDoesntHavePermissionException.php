<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 20-Jan-19
 * Time: 9:43
 */

namespace Authentication\Domain\Services\Exceptions;


use Symfony\Component\HttpFoundation\Response;

class UserDoesntHavePermissionException extends DomainException implements DomainExceptionInterface
{

    public function __construct(array $array)
    {
        $return['message'] = 'User does not have permission!';
        $return['resource'] = $array;
        parent::__construct(Response::HTTP_UNAUTHORIZED, $return);
    }
}
