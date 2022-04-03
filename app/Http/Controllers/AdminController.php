<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Services\AdminService;

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
    public function store(AdminRequest $adminRequest)
    {
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

        return $adminUser;
    }
}
