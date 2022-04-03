<?php

namespace App\Traits;

use App\Models\Admin;

trait AuthenticatedUserTrait
{
    public function user(): Admin
    {
        $admin = new Admin();
        return $admin->where("api_token", $this->apiKey())->first();
    }

    public function apiKey(): string
    {
        return request()->bearerToken();
    }

    public function id(): int
    {
        return $this->user()->id;
    }
}
