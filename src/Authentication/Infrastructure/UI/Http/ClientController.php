<?php

namespace Authentication\Infrastructure\UI\Http;

use Authentication\Application\Service\Client\CreateNewClientService;


class ClientController extends TransactionalRestController
{
    /**
     * @Rest\Post("/api/register/client" , name="new_client_register")
     */
    public function registerUser(CreateNewClientService $service, Request $request): JsonResponse
    {
        $response = $this->runAsTransaction(
            $service,
            new CreateNewClientService(
                $request->get('name'),
                $request->get('ip')
            )
            );
        return new JsonResponse($response, Response::HTTP_CREATED);
    }
}