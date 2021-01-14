<?php

namespace src\Router;
require "src/Controllers/ContactController.php";

use src\Controllers\ContactController;

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

    /**
     * Router constructor.
     *
     * Sets a new instance of ContactController to private field $contactController
     */
    public function __construct()
    {
        $this->contactController = new ContactController();

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
                    return $this->unprocessableEntityResponse();
                } else {
                    return $this->contactController->createContact($input);
                }
            case 'PUT':
                $input = (array)json_decode(file_get_contents('php://input'), TRUE);
                if (!$this->validateUpdateInput($input)) {
                    return $this->unprocessableEntityResponse();
                } else {
                    return $this->contactController->updateContact($contactId, $input);
                }
            default:
                return $this->notFoundResponse();
        }
    }

    /**
     * If the request method was not one of which the API can handle the processRequest
     * method calls notFoundResponse to return 404 error.
     *
     * @return array response data
     */
    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
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

    /**
     * If the passed in user input not matches the requirements
     * processRequest method calls unprocessableEntityResponse to return
     * with 422 Unprocessable error
     *
     * @return array response data
     */
    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input! All fields are required.'
        ]);
        return $response;
    }
}