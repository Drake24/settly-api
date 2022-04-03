<?php

namespace App\Classes;

use App\Classes\Response;
use App\Classes\ErrorData;

/**
 * The Response handler. Creates the response
 * message and error bag all throughout the application.
 * source: https://jsonapi.org/examples/
 */
class ErrorDataBuilder
{
    protected $errorData;
    protected $response;

    public function __construct()
    {
        $this->errorData = new ErrorData();
        $this->response = new Response();
    }

    /**
     * @param int $code
     *
     * @return void
     */
    public function setCode($code = 500): void
    {
        $this->errorData->setCode($code);
    }
    /**
     * @param string $name
     *
     * @return void
     */
    public function setDomain($name = 'Unknown'): void
    {
        $this->errorData->setDomain($name);
    }

    /**
     * @param string $message
     *
     * @return void
     */
    public function setMessage($message = 'Unknown'): void
    {
        $this->errorData->setMessage($message);
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function setData($data = []): void
    {
        $this->errorData->setData($data);
    }

    /**
     * Builds the error data bag. Contains the
     * necessary error data base on the JSON standard error format.
     *
     * @return array
     */
    public function build(): array
    {
        return $this->response->build($this->errorData->build());
    }
}
