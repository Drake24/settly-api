<?php

namespace App\Services;

use App\Services\Service;
use App\Models\Admin;
use App\Values\ServerMessages;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

use Auth;

class AuthenticateService extends Service
{
    protected $admin;

    public function __construct(Admin $admin)
    {
        parent::__construct();

        $this->admin = $admin;
    }

    /**
     * Authenticates user credentials when logging in.
     *
     * @param AuthenticateRequest $payload
     * @return void
     */
    public function authenticate(array $payload): Admin
    {
        if (!Auth::attempt([
            'email' => $payload['email'],
            'password' => $payload['password']
        ])) {
            $this->errorData->setMessage(ServerMessages::LOGIN_AUTHENTICATION_FAILURE);
            $this->errorData->setCode(423);

            throw new HttpResponseException(
                response()->json(
                    $this->errorData->build(),
                    423
                )
            );
        }

        $admin = Auth::user();
        $admin = $this->updateApiToken($admin->id);

        return $admin;
    }

    /**
     * Update apiToken with the newly generated one.
     *
     * @param int $id
     *
     * @return Admin
     */
    public function updateApiToken(int $id): Admin
    {
        $token = $this->generateApiToken();

        $admin = $this->admin->find($id);
        $admin->api_token = $token;
        $admin->save();

        return $admin;
    }

    /**
     * Generate random string as token
     *
     * @return string
     */
    public function generateApiToken(): string
    {
        $token = Str::random(60);

        return $token;
    }
}
