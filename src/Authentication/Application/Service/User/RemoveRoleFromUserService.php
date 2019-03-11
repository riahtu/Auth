<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 13-Jan-19
 * Time: 18:06
 */

namespace Authentication\Application\Service\User;


use Doctrine\ORM\EntityManagerInterface;
use Authentication\Application\DataTransformers\User\AllUserInfoDataTransformer;
use Transactional\Interfaces\TransactionalServiceInterface;

class RemoveRoleFromUserService extends UserApplicationService implements TransactionalServiceInterface
{
    /**
     * @var AllUserInfoDataTransformer
     */
    private $allUserInfoDataTransformer;

    public function __construct(EntityManagerInterface $entityManager , AllUserInfoDataTransformer $allUserInfoDataTransformer)
    {
        parent::__construct($entityManager);

        $this->allUserInfoDataTransformer = $allUserInfoDataTransformer;
    }

    /**
     * @param RemoveRoleFromUserRequest $request
     * @return array
     */
    public function execute($request = null)
    {
        $user = $this->findUserOrFail($request->getEmail());

        $role = $this->findRoleOrFail($request->getRole());

        $user->removeRole($role);

        return array(
            $this->allUserInfoDataTransformer->execute($user)
        );
    }
}
