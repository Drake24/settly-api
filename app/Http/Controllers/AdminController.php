<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Services\AdminService;
use App\Classes\Response;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Creates a new admin user.
     *
     * @param AdminRequest $adminRequest
     *
     * @return [type]
     */
    public function store(AdminRequest $adminRequest): JsonResponse
    {
        $response = new Response();

        $payload = [
            'first_name' => $adminRequest->get('firstName'),
            'last_name' => $adminRequest->get('lastName'),
            'email' => $adminRequest->get('email'),
            'emailRepeat' => $adminRequest->get('emailRepeat'),
            'password' => $adminRequest->get('password'),
            'passwordRepeat' => $adminRequest->get('passwordRepeat'),
            'recaptcha' => $adminRequest->get('recaptcha'),
        ];

        $adminUser = $this->adminService->createAdmin($payload);

        return response()->json(
            $response->build($adminUser),
            200
        );
    }
}
