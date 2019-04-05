<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 20-Jan-19
 * Time: 9:33
 */

namespace Authentication\Domain\Services\Permission;


use Authentication\Domain\Entity\Client\Client;
use Doctrine\ORM\EntityManagerInterface;
use Authentication\Domain\Entity\Role;
use Authentication\Domain\Entity\User\User;
use Authentication\Domain\Services\Exceptions\UserDoesntHavePermissionException;

class CheckForPermissionService
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param $user
     * @param $route
     *
     */
    public function execute(
        $user,
        $route
    ): void
    {
        if($user instanceof User){
            if(!$user->hasPermission($route)){
                throw new UserDoesntHavePermissionException(['username' => $user->getUsername()]);
            }
        }else if($user instanceof Client){
            if(!$user->hasPermission($route)){
                throw new UserDoesntHavePermissionException(['client' => $user->getLastActiveAccessToken()->getToken()]);
            }
        }else{
            $role = $this->em->getRepository(Role::class)->findByReference(Role::ANON_ROLE);
            $permission = $role->hasPermission($route);
            if(!$permission){
                throw new UserDoesntHavePermissionException(['username' => 'Anon']);
            }
        }
    }
}
