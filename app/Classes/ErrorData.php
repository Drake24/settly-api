<?php

namespace App\Classes;

use App\Values\ServerMessages;

use Log;

/**
 *  The Response Error class handles the error
 *  message bag and formats it following standard
 *  source: https://jsonapi.org/examples/
 */
class ErrorData
{
    protected $code;
    protected $data;
    protected $domain;
    protected $message;
    protected $success;

    public function __construct(
        $code = 500,
        $message = ServerMessages::SERVER_ERROR,
        $domain = '',
        $data = [],
        $success = false
    ) {
        $this->code = $code;
        $this->data = $data;
        $this->domain = $domain;
        $this->message = $message;
        $this->success = $success;
    }

    /**
     * Builds the Response ERROR [Data] following the RESTFUL JREST
     * guide and Google Restful Guide. { error: {}, success: true ...}
     *
     * source: https://jsonapi.org/examples/
     *
     * @return array
     */
    public function build(): array
    {
        $errors = [
            'code' => $this->code,
            'data' => $this->data,
            'domain' => $this->domain,
            'message' => $this->message,
            'success' => $this->success
        ];

        return $errors;
    }

    /**
     * Sets the HTTP response code.
     *
     * @param int $code
     *
     * @return void
     */
    public function setCode(int $code = 500): void
    {
        $this->code = $code;
    }

    /**
     * Sets the domain in where the error occurred for
     * easy tracing.
     *
     * @param string $domain
     *
     * @return void
     */
    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    /**
     * Sets the general error message on the message
     * data array.
     *
     * @param string $message
     *
     * @return void
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * The success flag. Determine warnings or error flag
     * here to determine.
     *
     * @param bool $success
     *
     * @return void
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    /**
     * Sets the data message that can be accessed later
     * on in the application.
     *
     * @param mixed $data
     *
     * @return void
     */
    public function setData($data = []): void
    {
        $this->data = $data;
    }

}
