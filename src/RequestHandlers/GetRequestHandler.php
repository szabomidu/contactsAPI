<?php

namespace src\RequestHandlers;
require "src/Controllers/ContactController.php";

use src\Controllers\ContactController;

class GetRequestHandler
{
    private ContactController $contactController;

    /**
     * GetRequestHandler constructor.
     */
    public function __construct()
    {
        $this->contactController = new ContactController();
    }

    
    public function receiveRequest($contactId): array
    {
        return $contactId 
            ? $this->contactController->getContactById($contactId) 
            : $this->contactController->getAllContacts();
    }

}