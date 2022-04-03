<?php

namespace App\Services;

use App\Models\Admin;
use App\Services\RecaptchaService;
use App\Values\ServerMessages;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Exception;

class AdminService extends Service
{
    protected $admin;
    protected $recaptchaService;

    public function __construct(Admin $admin, RecaptchaService $recaptchaService)
    {
        parent::__construct();

        $this->admin = $admin;
        $this->recaptchaService = $recaptchaService;
    }

    /**
     * Creates the admin account.
     *
     * @param array $payload
     *
     * @return Admin
     */
    public function createAdmin(array $payload = []): Admin
    {
        $isReCAPTCHASuccess = $this->recaptchaService->validate($payload['recaptcha']);

        // Fail reCAPTCHA
        if (!$isReCAPTCHASuccess) {
            $this->errorData->setMessage(ServerMessages::RECAPTCHA_ERROR);
            $this->errorData->setCode(423);

            throw new HttpResponseException(
                response()->json(
                    $this->errorData->build(), 423
                )
            );
        }

        try {
            $admin = $this->admin->create([
                'first_name' => $payload['first_name'],
                'last_name' => $payload['last_name'],
                'email' => $payload['email'],
                'password' => Hash::make($payload['password']),
                'api_token' => Str::random(60),
            ]);
        } catch (Exception $e) {

            $this->errorData->setMessage(ServerMessages::SERVER_ADMIN_CREATE_FAILURE);
            $this->errorData->setCode(423);

            throw new HttpResponseException(
                response()->json(
                    $this->errorData->build(), 423
                )
            );
        }

        return $admin;
    }
}
