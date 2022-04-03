<?php

namespace App\Services;

use App\Models\Client;
use App\Values\ServerMessages;
use App\Traits\AuthenticatedUserTrait;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\Eloquent\Collection;

use Exception;

class ClientService extends Service
{
    use AuthenticatedUserTrait;

    protected $client;

    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    /**
     * Gets all client lists for email delivery.
     *
     * @return array|null
     */
    public function getClientsList(): ?array
    {
        try {
            $clients = $this->client->get()->toArray();
        } catch (Exception $e) {
            $this->errorData->setMessage(ServerMessages::SERVER_CLIENT_RETRIEVE_FAILURE);
            $this->errorData->setCode(500);

            throw new HttpResponseException(
                response()->json(
                    $this->errorData->build(),
                    500
                )
            );
        }

        return $clients;
    }

    /**
     * Gets all clients associated with the logged
     * user only.
     *
     * @return Collection|null
     */
    public function getClients(): ?Collection
    {
        try {
            $clients = $this->client->where('admin_id', $this->id())->get();
        } catch (Exception $e) {

            $this->errorData->setMessage(ServerMessages::SERVER_CLIENT_RETRIEVE_FAILURE);
            $this->errorData->setCode(500);

            throw new HttpResponseException(
                response()->json(
                    $this->errorData->build(),
                    500
                )
            );
        }

        return $clients;
    }

    /**
     * Creates a client
     *
     * @param array $payload
     *
     * @return Client
     */
    public function createClientUser(array $payload = []): Client
    {
        try {
            $client = $this->client->create([
                'first_name' => $payload['first_name'],
                'last_name' => $payload['last_name'],
                'email' => $payload['email'],
                // 'profile_photo' => $payload['profile_photo'],
                'admin_id' => $this->id(),
            ]);

            $payload['file']->move(public_path('images'), 'test.jpg');
        } catch (Exception $e) {

            $this->errorData->setMessage(ServerMessages::SERVER_CLIENT_CREATE_FAILURE);
            $this->errorData->setCode(500);

            throw new HttpResponseException(
                response()->json(
                    $this->errorData->build(),
                    500
                )
            );
        }

        return $client;
    }

    /**
     * Gets the client by using the clientId passed
     *
     * @param int $clientId
     *
     * @return Client
     */
    public function getClient(int $clientId): Client
    {
        try {
            $client = $this->client->findOrFail($clientId);
        } catch (ModelNotFoundException $e) {

            $this->errorData->setMessage(ServerMessages::SERVER_CLIENT_RECORD_NOT_FOUND);
            $this->errorData->setCode(404);

            throw new HttpResponseException(
                response()->json(
                    $this->errorData->build(),
                    404
                )
            );
        }

        return $client;
    }

    /**
     * Deletes the cliet (hard-delete)
     *
     * @param int $clientId
     *
     * @return Client
     */
    public function deleteClient(int $clientId): Client
    {
        $client = $this->client->findOrFail($clientId);

        try {
            $client->delete();
        } catch (Exception $e) {

            $this->errorData->setMessage(ServerMessages::SERVER_CLIENT_DELETE_FAILURE);
            $this->errorData->setCode(500);

            throw new HttpResponseException(
                response()->json(
                    $this->errorData->build(),
                    500
                )
            );
        }

        return $client;
    }

    /**
     * Updates the client
     *
     * @param int $clientId
     * @param array $payload
     *
     * @return Client
     */
    public function updateClient(int $clientId, array $payload): Client
    {
        $client = $this->client->findOrFail($clientId);
        try {
            $client->first_name = $payload['first_name'];
            $client->last_name = $payload['last_name'];
            $client->email = $payload['email'];
            $client->save();
        } catch (Exception $e) {

            $this->errorData->setMessage(ServerMessages::SERVER_CLIENT_UPDATE_FAILURE);
            $this->errorData->setCode(500);

            throw new HttpResponseException(
                response()->json(
                    $this->errorData->build(),
                    500
                )
            );
        }

        return $client;
    }
}
