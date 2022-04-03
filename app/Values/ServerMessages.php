<?php

namespace App\Values;

class ServerMessages
{
    // General error messages.
    const SUCCESS = 'Success';
    const ERROR = 'There is something wrong processing your request.';
    const SERVER_ERROR = 'There was an error processing your request.';
    const UNAUTHORIZE_ACCESS_RESOURCE = 'Request is not authorize to access resource.';

    // Specific layer error messages.
    const FORM_VALIDATION_ERROR = 'There is something wrong with your form.';
    const LOGIN_AUTHENTICATION_FAILURE = 'Invalid username or password.';
    const AUTHENTICATION_NO_ACCESS_KEY_PROVIDED = 'No api key provided.';
    const AUTHENTICATION_TOKEN_MISMATCH = 'Token mismatch or has expired.';
    const RECAPTCHA_ERROR = 'There was an error validating reCAPTCHA token.';

    const SERVER_ADMIN_CREATE_FAILURE = 'Fail to create admin account.';
    const SERVER_CLIENT_RECORD_NOT_FOUND = 'Client record could not be found.';
    const SERVER_CLIENT_CREATE_FAILURE = 'Client record could not be created.';
    const SERVER_CLIENT_DELETE_FAILURE = 'Client record could not be deleted.';
    const SERVER_CLIENT_UPDATE_FAILURE = 'Client record could not be updated.';
    const SERVER_CLIENT_RETRIEVE_FAILURE = 'There is wrong retrieving lists of clients';
}
