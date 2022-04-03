<?php

namespace App\Http\Requests;

use App\Values\ServerMessages;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Log;

class AuthenticateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * Must match with FrontEnd fields
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => 'The :attribute must not be left blanked.',
        ];
    }

    /**
     * Failed validation.
     *
     * @param Validator $validator
     *
     * @return HttpResponseException
     */
    protected function failedValidation(Validator $validator): HttpResponseException
    {
        $this->errorData->setMessage(ServerMessages::FORM_VALIDATION_ERROR);
        $this->errorData->setData($validator->errors());
        $this->errorData->setCode(423);

        throw new HttpResponseException(
            response()->json(
                $this->errorData->build(), 423
            )
        );
    }
}
