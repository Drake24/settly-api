<?php

namespace App\Http\Middleware;

use App\Classes\ErrorData;
use App\Classes\Response;
use App\Models\Admin;
use App\Values\ServerMessages;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;

class Authenticate extends Middleware
{
    protected $errorData;
    protected $admin;

    public function __construct(ErrorData $error, Admin $admin)
    {
        $this->errorData = $error;
        $this->admin = $admin;
    }

    public function handle($request, $next, ...$guards)
    {
        $response = new Response();

        $apiToken = $request->bearerToken();
        // Has no Authorization Bearer
        if (!$apiToken) {

            $response->setErrorMessage(ServerMessages::UNAUTHORIZE_ACCESS_RESOURCE);

            $this->errorData->setMessage(ServerMessages::AUTHENTICATION_NO_ACCESS_KEY_PROVIDED);
            $this->errorData->setCode(401);

            throw new HttpResponseException(
                response()->json(
                    $response->build($this->errorData->build()),
                    401
                )
            );
        }

        // Has Authorization Token
        if ($apiToken) {

            $user = $this->admin->where("api_token", $apiToken)->first();
            // No user matched with passed token
            if (!$user) {
                $response->setErrorMessage(ServerMessages::UNAUTHORIZE_ACCESS_RESOURCE);

                $this->errorData->setMessage(ServerMessages::AUTHENTICATION_TOKEN_MISMATCH);
                $this->errorData->setCode(401);

                throw new HttpResponseException(
                    response()->json(
                        $response->build($this->errorData->build()),
                        401
                    )
                );
            }
        }

        return $next($request);
    }
}
