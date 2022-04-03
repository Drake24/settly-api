<?php

namespace App\Http\Requests;

use App\Classes\ErrorDataBuilder;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    protected $errorData;

    public function __construct(ErrorDataBuilder $errorData)
    {
        $this->errorData = $errorData;
    }
}
