<?php

namespace Authentication\Infrastructure\UI\Http;

use FOS\RestBundle\Controller\Annotations as Rest;
use Authentication\Application\Service\Role\CreateNewRoleRequest;
use Authentication\Application\Service\Role\CreateNewRoleService;
use Authentication\Application\Service\Role\RemoveRoleRequest;
use Authentication\Application\Service\Role\RemoveRoleService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Transactional\TransactionalRestController;

/**
 * Class RoleController
 * @package Authentication\Infrastructure\UI\Http
 *
 */
class RoleController extends TransactionalRestController
{

    /**
     * @param CreateNewRoleService $service
     * @param Request $request
     *
     *
     * @return JsonResponse
     *
     * @Rest\Post("/api/role/new" , name="make_role")
     */
    public function makeNewRole(CreateNewRoleService $service, Request $request): JsonResponse
    {
        $response = $this->runAsTransaction(
            $service,
            new CreateNewRoleRequest(
                $request->get('roleName'),
                $request->get('roleReference')
            )
        );

        return new JsonResponse($response, Response::HTTP_CREATED);
    }

    /**
     * @param RemoveRoleService $service
     * @param Request $request
     *
     *
     * @return JsonResponse
     *
     * @Rest\Delete("/api/role/delete" , name="delete_role")
     */
    public function removeRole(RemoveRoleService $service, Request $request): JsonResponse
    {
        $response = $this->runAsTransaction(
            $service,
            new RemoveRoleRequest(
                $request->get('roleReference')
            )
        );

        return new JsonResponse($response, Response::HTTP_OK);
    }

}
