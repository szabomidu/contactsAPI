<?php

namespace src\RequestHandlers;

use src\Response\ResponseFactory;
use src\Controllers\ContactController;

/**
 * Class PostRequestHandler's task is to handle POST requests.
 *
 * @package src\RequestHandlers
 */
class PostRequestHandler
{
    private ContactController $contactController;
    private ResponseFactory $responseFactory;

    /**
     * GetRequestHandler constructor.
     * Sets a new instance of ContactController as a private field.
     * Sets a new instance of ResponseFactory as a private field.
     */
    public function __construct()
    {
        $this->contactController = new ContactController();
        $this->responseFactory = new ResponseFactory();
    }

    /**
     * This method is called from Router class. If input data is valid,
     * calls createContact method, returns response with 422 status otherwise.
     *
     * @param array $input associative array containing user input
     * @return array response
     */
    public function receiveRequest(array $input): array
    {
        return !$this->validateInput($input)
            ? $this->responseFactory->createResponse("422",
                ['error' => 'Invalid input! All fields are required.'])
            : $this->contactController->createContact($input);
    }

    /**
     * This method checks if all required input data is present.
     *
     * @param array $input associative array containing user input
     * @return bool true if all required data is present, false otherwise
     */
    private function validateInput(array $input): bool
    {
        if (!isset($input['name'])) {
            return false;
        }
        if (!isset($input['phone_number'])) {
            return false;
        }
        if (!isset($input['email'])) {
            return false;
        }
        if (!isset($input['address'])) {
            return false;
        }
        return true;
    }
}

