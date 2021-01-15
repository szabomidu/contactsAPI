<?php
namespace src\RequestHandlers;

use src\Controllers\ContactController;
use src\Response\ResponseFactory;

class PutRequestHandler
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
     * @param $contactId
     * @return array
     */
    public function receiveRequest($input, $contactId): array
    {
        return !$this->validateInput($input)
            ? $this->responseFactory->createResponse("422",
                ['error' => 'Invalid input! All fields are required.'])
            : $this->contactController->updateContact($contactId, $input);
    }

    /**
     * If the request method is PUT processRequest method calls validateUpdate method
     * to check if the required update input data is present.
     *
     * @param array $input associative array containing user input
     * @return bool tru is required data is present, false otherwise
     */
    private function validateInput(array $input): bool
    {
        if (!isset($input["email"])) {
            return false;
        }
        return true;
    }
}



