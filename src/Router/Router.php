<?php

namespace src\Router;
require "src/Controllers/ContactController.php";

use src\Controllers\ContactController;

class Router
{
    private ContactController $contactController;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->contactController = new ContactController();

    }

    public function processRequest($requestMethod, $contactId)
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

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

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

    private function validateUpdateInput(array $input)
    {
        if (!isset($input["email"])) {
            return false;
        }
        return true;
    }

    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input! All fields are required.'
        ]);
        return $response;
    }
}