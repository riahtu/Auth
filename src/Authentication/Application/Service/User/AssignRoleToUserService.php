<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 13-Jan-19
 * Time: 16:18
 */

namespace Authentication\Application\Service\User;


use Transactional\Interfaces\TransactionalServiceInterface;

class AssignRoleToUserService extends UserApplicationService implements TransactionalServiceInterface
{
    /**
     * @param AssignRoleToUserRequest $request
     * @return array
     */
    public function execute($request = null)
    {
        $user = $this->findUserOrFail($request->getEmail());

        $role = $this->findRoleOrFail($request->getRole());

        $user->addRole($role);

        return array(
            'role' => $role->getRole(),
            'user' => $user->getUsername()
        );
    }
}
