<?php

namespace App\Services;

use App\Classes\ErrorDataBuilder;

class Service
{
    /**
     * An instance of the ErrorDataBuilder. Call error
     * data to set the error messages that are found in the
     * Service layer.
     *
     * @var ErrorDataBuilder
     */
    protected $errorData;

    public function __construct()
    {
        $this->errorData = new ErrorDataBuilder();
    }
}
