<?php

namespace src\Router;
require "src/Controllers/ContactController.php";

use src\Controllers\ContactController;
use src\Response\ResponseFactory;

/**
 * Class Router
 *
 * Router class is responsible for calling the right method depending on the
 * request method and the URI parameters.
 *
 * @package src\Router
 */
class Router
{
    private ContactController $contactController;
    private ResponseFactory $responseFactory;

    /**
     * Router constructor.
     *
     * Sets a new instance of ContactController to private field $contactController
     */
    public function __construct()
    {
        $this->contactController = new ContactController();
        $this->responseFactory = new ResponseFactory();

    }

    /**
     * ProcessRequest method calles the correct method depending on the request
     * and wheter or not contactId is present.
     *
     * @param $requestMethod string request method
     * @param $contactId integer id from URL or null if not present
     * @return array response data
     */
    public function processRequest(string $requestMethod, int $contactId)
    {
        switch ($requestMethod) {
            case 'GET':
                if ($contactId) {
                    return $this->contactController->getContactById($contactId);
                } else {
                    return $this->contactController->getAllContacts();
                }
            case 'POST':
                $input = (array)json_decode(file_get_contents('php://input'), TRUE);
                if (!$this->validateInput($input)) {
                    return $this->responseFactory->createResponse("422", [
                        'error' => 'Invalid input! All fields are required.'
                    ]);
                } else {
                    return $this->contactController->createContact($input);
                }
            case 'PUT':
                $input = (array)json_decode(file_get_contents('php://input'), TRUE);
                if (!$this->validateUpdateInput($input)) {
                    return $this->responseFactory->createResponse("422", [
                        'error' => 'Invalid input! All fields are required.'
                    ]);
                } else {
                    return $this->contactController->updateContact($contactId, $input);
                }
            default:
                return $this->responseFactory->createResponse("404", null);
        }
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

    /**
     * If the request method is PUT processRequest method calls validateUpdate method
     * to check if the required update input data is present.
     *
     * @param array $input associative array containing user input
     * @return bool tru is required data is present, false otherwise
     */
    private function validateUpdateInput(array $input)
    {
        if (!isset($input["email"])) {
            return false;
        }
        return true;
    }
}