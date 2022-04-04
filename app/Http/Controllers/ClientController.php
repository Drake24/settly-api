<?php

namespace App\Http\Controllers;

use App\Classes\Response;
use App\Http\Requests\ClientRequest;
use App\Services\ClientService;

use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Retrieves all clients according to the
     * the logged user.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $response = new Response();

        $clients = $this->clientService->getClients();

        return response()->json(
            $response->build($clients),
            200
        );
    }

    /**
     * Creates a new client.
     *
     * @param ClientRequest $clientRequest
     *
     * @return [type]
     */
    public function store(ClientRequest $clientRequest): JsonResponse
    {
        $payload = [
            'first_name' => $clientRequest->get('firstName'),
            'last_name' => $clientRequest->get('lastName'),
            'email' => $clientRequest->get('email'),
            'file' => $clientRequest->file('file') ?? null,
        ];

        $client = $this->clientService->createClientUser($payload);

        return $client;
    }

    /**
     * Retrives client.
     *
     * @param int $clientId
     *
     * @return JsonResponse
     */
    public function show(int $clientId): JsonResponse
    {
        $response = new Response();

        $client = $this->clientService->getClient($clientId);

        return response()->json(
            $response->build($client),
            200
        );
    }

    /**
     * Updates client.
     *
     * @param int $clientId
     * @param ClientRequest $clientRequest
     *
     * @return JsonResponse
     */
    public function update(int $clientId, ClientRequest $clientRequest): JsonResponse
    {
        $response = new Response();

        $payload = [
            'first_name' => $clientRequest->get('firstName'),
            'last_name' => $clientRequest->get('lastName'),
            'email' => $clientRequest->get('email'),
            'file' => $clientRequest->file('file') ?? null,
        ];

        $client = $this->clientService->updateClient($clientId, $payload);

        return response()->json(
            $response->build($client),
            200
        );
    }

    /**
     * Delete's client.
     *
     * @param int $clientId
     *
     * @return JsonResponse
     */
    public function destroy(int $clientId): JsonResponse
    {
        $response = new Response();

        $client = $this->clientService->deleteClient($clientId);

        return response()->json(
            $response->build($client),
            200
        );
    }
}
