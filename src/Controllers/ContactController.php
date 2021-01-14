<?php


namespace src\Controllers;

require "src/Database/Connection/Connection.php";
require "src/Database/Queries/ContactQueries.php";

use PDO;
use src\Database\Connection\Connection;
use src\Database\Queries\ContactQueries;

class ContactController
{
    private ?PDO $PDO = null;
    private $contactQueries = null;

    /**
     * ContactController constructor.
     */
    public function __construct()
    {
        $connection = new Connection();
        $this->PDO = $connection->getConnection();
        $this->contactQueries = new ContactQueries();
    }

    public function getContactById($contactId)
    {
        $result = $this->contactQueries->findContactById($this->PDO, $contactId);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    public function getAllContacts()
    {
        $result = $this->contactQueries->getAllContacts($this->PDO);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    public function createContact($input)
    {
        $result = $this->contactQueries->createNewContact($this->PDO, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    public function updateContact($contactId, $input)
    {
        $this->contactQueries->updateContact($this->PDO, $input, $contactId);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $contactId;
        return $response;
    }
}