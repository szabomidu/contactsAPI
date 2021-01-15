<?php


namespace src\Controllers;

require "src/Database/Connection/Connection.php";
require "src/Database/Queries/ContactQueries.php";
require "src/Response/ResponseFactory.php";


use PDO;
use src\Response\ResponseFactory;
use src\Database\Connection\Connection;
use src\Database\Queries\ContactQueries;

/**
 * Class ContactController
 *
 * ContactController's task is to call the corresponding ContactQuery method
 * and return the result of it and a response header.
 *
 * @package src\Controllers
 */
class ContactController
{
    private ?PDO $PDO;
    private ?ContactQueries $contactQueries;
    private ResponseFactory $responseFactory;

    /**
     * ContactController constructor.
     *
     * Sets instance of PDO as private parameter $PDO.
     * Sets ContactQueries' instance as private parameter $contactQueries.
     */
    public function __construct()
    {
        $connection = new Connection();
        $this->PDO = $connection->getConnection();
        $this->contactQueries = new ContactQueries();
        $this->responseFactory = new ResponseFactory();
    }

    /**
     * Calls ContactQueries findContactById method, sets response header to 200 OK,
     * sets response body to the result from the queries method.
     *
     * @param $contactId Integer id of the desired contact
     * @return array response data
     */
    public function getContactById(int $contactId): array
    {
        $result = $this->contactQueries->findContactById($this->PDO, $contactId);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    /**
     * Calls ContactQueries getAllContacts method, sets response header to 200 OK,
     * sets response body to the result from the queries method.
     *
     * @return array response data
     */
    public function getAllContacts()
    {
        $result = $this->contactQueries->getAllContacts($this->PDO);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    /**
     * Calls ContactQueries createNewContact method, sets response header to 200 OK,
     * sets response body to the result from the queries method.
     *
     * @param $input array associative array containing user input
     * @return array response data
     */
    public function createContact(array $input)
    {
        $result = $this->contactQueries->createNewContact($this->PDO, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    /**
     * Calls ContactQueries updateContact method, sets response header to 200 OK,
     * sets response body to the result from the queries method.
     *
     * @param $contactId integer id of the contact to be updated
     * @param $input array associative array containing user input
     * @return array response data
     */
    public function updateContact(int $contactId, array $input)
    {
        $this->contactQueries->updateContact($this->PDO, $input, $contactId);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = $contactId;
        return $response;
    }
}