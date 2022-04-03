<?php

namespace App\Classes;

use App\Values\ServerMessages;

class Response
{
    /**
     * The HTTP response code
     *
     * @var int
     */
    protected $code;


    /**
     * The data that returned containing the
     * request OR error message datas.
     *
     * @var array
     */
    protected $data;

    /**
     * The outer message of the HTTP response.
     *
     * @var string
     */
    protected $message;

    /**
     * The HTTP response if it is success or failure.
     * @var bool
     */
    protected $success;

    /**
     * The error message. The default error message or
     * custom error message being passed.
     *
     * @var string
     */
    protected $errorMessage;

    // Note to self. Setting the message on the root of the response
    // was the reason this class was created as to follow the JSEND guidelines.
    // Laravel/Lumen does not have a 'message' root for JSON response.
    public function __construct(
        $code = 200,
        $data = null,
        $message = '',
        $success = true,
    ) {
        // Root JSON response objects.
        $this->code = $code;
        $this->data = $data;
        $this->message = $message;
        $this->success = $success;
    }

    /**
     * Builds the Response data following the RESTFUL JREST
     * guide and Google Restful Guide.
     *
     * source: https://jsonapi.org/examples/
     * @param $data - the data to be build as a RESTFUL format.
     * @param $message - the message to be used. ? Trivial if there is both a success
     * and error and you want to add a custom error message, pass a message here to be
     * set as en error message. Otherwise both use default messages.
     *
     * @return array
     */
    public function build($data): array
    {
        // Extract the passed data. We will use what is set
        // in the data for the status and message. Otherwise apply
        // default.
        $this->createHTTPStatusCode($data);
        $this->createSuccess($data);
        $this->createMessage();

        $code = $this->getCode();
        $message = $this->getMessage();
        $success = $this->getSuccess();

        return $this->formatJSON($data, $message, $success, $code);
    }

    /**
     * Convert Keys to Camel Case
     * Convert all keys to camel case for front-end consumption.
     * i.e database column names are in snake_case. Use this function
     * to convert snake_case column names to camelCase.
     *
     * @param $data - the data to be formatted to camelCase.
     *
     * @return array
     */
    public static function keysToCamelCase($data): array
    {
        if (!is_array($data)) {
            $data = $data->toArray();
        }

        $camelCaseArray = [];
        foreach ($data as $key => $value) {
            if (preg_match('/_/', $key)) {
                preg_match('/[^_]*/', $key, $m);
                preg_match('/(_)([a-zA-Z]*)/', $key, $v);
                $key = $m[0] . ucfirst($v[2]);
            }

            if (is_array($value))
                $value = self::keysToCamelCase($value);

            $camelCaseArray[$key] = $value;
        }
        return $camelCaseArray;
    }

    /**
     * Creates readable formatted JSON data.
     *
     * @param $data - the data to be returned.
     * @param string $message - the server message.
     * @param bool $success - category of the return if success or fail.
     * @param int $code - the http status code.
     *
     * @return array
     */
    public function formatJSON(
        $data = null,
        string $message = null,
        bool $success = null,
        int $code = null
    ): array {

        // Sets the data, message, and code base on the passed data.
        // The names are the root JSON object of the response.
        $data = self::keysToCamelCase(is_null($data) ? $this->data : $data);
        $message = is_null($message) ? $this->message : $message;
        $code = is_null($code) ? $this->code : $code;

        $responseKey = (boolval(is_null($success)) ? $this->success : $success)
            ? 'data'
            : 'errors';

        return [
            $responseKey => $data,
            'message' => $message,
            'code' => $code,
            'success' => $success,
        ];
    }

    /**
     * Checks the passed data object if it contains a status code.
     *
     * @param $data - the data to be inspected. Usually the array data.
     *
     * @return void
     */
    public function createHTTPStatusCode($data): void
    {
        // ? If there is no CODE return we can assume that it is a success response.
        $this->code = strpos(json_encode($data), 'code') > 0 ? $data['code'] : 200; // Unknown;
    }

    /**
     * Check if return data from Service is a success or an exception.
     *
     * @param $data - the data to be inspected. Usually the array data.
     *
     * @return void
     */
    public function createSuccess($data): void
    {
        $this->success = strpos(json_encode($data), 'code') > 0 ? false : true;
    }

    /**
     * Returns the HTTP error code to be returned be used and returned to the server.
     *
     * @param string $message(optional) - the message to be created
     *
     * @return void
     */
    public function createMessage(): void
    {
        $success = $this->getSuccess();

        // If no success message is passed use default success.
        // Otherwise use passed message.
        $this->message = empty($this->message) ? ServerMessages::SUCCESS : $this->message;

        // If error is false and no default message is pass use general client error message.
        // Otherwise use passed message from the getErrorMessage;
        if (!$success) {
            $this->message = empty($this->errorMessage) ? ServerMessages::ERROR : $this->getErrorMessage();
        }
    }

    /**
     * Returns the HTTP error code to be returned be used and returned to the server.
     *
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * Returns the type of JSON request if success or not
     *
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Returns the server message.
     *
     * @param $data - An array of data that contains the 'message' key.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Sets the data object.
     *
     * @param $data - An array of data.
     *
     * @return void
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * Sets the data object.
     *
     * @param $data - An array of data.
     *
     * @return void
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * Sets the message.
     *
     * @param $message -the server message.
     *
     * @return void
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * Sets the type of http response.
     *
     * @param $success -the type of http response.
     *
     * @return void
     */
    public function setSuccess($success): void
    {
        $this->success = $success;
    }

    /**
     * Sets the error message
     *
     * @param mixed $errorMessage
     *
     * @return void
     */
    public function setErrorMessage($errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }
}
