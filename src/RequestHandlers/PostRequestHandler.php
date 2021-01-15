<?php

namespace src\RequestHandlers;

use src\Response\ResponseFactory;
use src\Controllers\ContactController;

/**
 * Class PostRequestHandler
 * @package src\RequestHandlers
 */
class PostRequestHandler
{
    private ContactController $contactController;
    private ResponseFactory $responseFactory;

    /**
     * GetRequestHandler constructor.
     */
    public function __construct()
    {
        $this->contactController = new ContactController();
        $this->responseFactory = new ResponseFactory();
    }

    /**
     * @param $input
     * @return array
     */
    public function receiveRequest($input): array
    {
        return !$this->validateInput($input)
            ? $this->responseFactory->createResponse("422",
                ['error' => 'Invalid input! All fields are required.'])
            : $this->contactController->createContact($input);
    }

    /**
     * If the request method is POST processRequest method calls validateInput method
     * to check if all required input data is present.
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

