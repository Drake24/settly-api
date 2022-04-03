<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RecaptchaService
{
    /**
     * Returns if the recaptcha string passed
     * or failed.
     *
     * @param string $recaptcha
     *
     * @return bool
     */
    public function validate(string $recaptcha): bool
    {
        $response = Http::asForm()->post(env("GOOGLE_RECAPTCHA_URL"), [
            'secret' => env("GOOGLE_RECAPTCHA_SECRET"),
            'response' => $recaptcha,
        ]);

        if ($response['success'] == 1) {
            return true;
        }

        return false;
    }
}
