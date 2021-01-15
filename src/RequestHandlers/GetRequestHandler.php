<?php

namespace src\RequestHandlers;
require "src/Controllers/ContactController.php";

use src\Controllers\ContactController;

/**
 * Class GetRequestHandler's task is to handle GET requests.
 *
 * @package src\RequestHandlers
 */
class GetRequestHandler
{
    private ContactController $contactController;

    /**
     * GetRequestHandler constructor.
     * Sets a new instance of ContactController as a private field.
     */
    public function __construct()
    {
        $this->contactController = new ContactController();
    }

    /**
     * Method which is called from Router class. If contactId is present
     * calls contactControllers getContactById method, calls getAllContacts
     * method otherwise.
     *
     * @param $contactId
     * @return array
     */
    public function receiveRequest($contactId): array
    {
        return $contactId 
            ? $this->contactController->getContactById($contactId) 
            : $this->contactController->getAllContacts();
    }

}