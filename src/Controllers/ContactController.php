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
}