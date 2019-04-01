<?php

namespace Authentication\Infrastructure\UI\Http;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Authentication\Application\Service\Client\CreateNewClientService;
use Authentication\Application\Service\Client\CreateNewClientRequest;


class ClientController extends TransactionalRestController
{
    /**
     * @Rest\Post("/api/register/client" , name="new_client_register")
     * @param CreateNewClientService $service
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function registerUser(CreateNewClientService $service, Request $request): JsonResponse
    {
        $response = $this->runAsTransaction(
            $service,
            new CreateNewClientRequest(
                $request->get('name'),
                $request->getClientIp()
            )
            );
        return new JsonResponse($response, Response::HTTP_CREATED);
    }
}
