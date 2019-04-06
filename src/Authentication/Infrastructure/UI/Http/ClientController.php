<?php

namespace Authentication\Infrastructure\UI\Http;

use Authentication\Application\Service\Client\GetPublicKeyRequest;
use Authentication\Application\Service\Client\GetPublicKeyService;
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

    /**
     * @Rest\Post("/api/client/key" , name="get_public_key")
     * @param GetPublicKeyService $service
     *
     * @return JsonResponse
     */
    public function getPublicKey(GetPublicKeyService $service): JsonResponse
    {
        $result =  $service->execute(
            new GetPublicKeyRequest(
                $this->getUser()
            )
        );

        return new JsonResponse($result, JsonResponse::HTTP_OK);
    }
}
