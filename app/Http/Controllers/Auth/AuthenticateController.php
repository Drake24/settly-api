<?php

namespace App\Http\Controllers\Auth;

use App\Classes\Response;
use App\Http\Requests\AuthenticateRequest;
use App\Http\Controllers\Controller;
use App\Services\AuthenticateService;

use Illuminate\Http\JsonResponse;

class AuthenticateController extends Controller
{
    protected $authenticateService;

    public function __construct(AuthenticateService $authenticateService)
    {
         $this->authenticateService = $authenticateService;
    }

    /**
     * Checks if given email address and password matches what is
     * stored in the database. Returns the authenticated user/admin.
     *
     * @param AuthenticateRequest $authenticateRequest
     *
     * @return JsonResponse
     */
    public function authenticate(AuthenticateRequest $authenticateRequest): JsonResponse
    {
        $response = new Response();

        $payload = [
            'email' => $authenticateRequest->get('email'),
            'password' => $authenticateRequest->get('password'),
        ];

        // Calls the authenticate service.
        $admin = $this->authenticateService->authenticate($payload);

        return response()->json(
            $response->build($admin), 200
        );
    }
}
