<?php
namespace src\RequestHandlers;

use src\Controllers\ContactController;
use src\Response\ResponseFactory;

/**
 * Class PutRequestHandler's task is to handle PUT requests.
 * @package src\RequestHandlers
 */
class PutRequestHandler
{
    private ContactController $contactController;
    private ResponseFactory $responseFactory;

    /**
     * GetRequestHandler constructor.
     *
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
     * @param int|null $contactId id passed into the URL
     * @return array
     */
    public function receiveRequest(array $input, ?int $contactId): array
    {
        return !$this->validateInput($input) || !$contactId
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



