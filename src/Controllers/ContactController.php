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
 * and return the result of it as a response.
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
     * Sets ResponseFactory's instance as private parameter $responseFactory.
     */
    public function __construct()
    {
        $connection = new Connection();
        $this->PDO = $connection->getConnection();
        $this->contactQueries = new ContactQueries();
        $this->responseFactory = new ResponseFactory();
    }

    /**
     * Calls ContactQueries findContactById method, calls responseFactory's
     * createResponse method with 200 status and result as body.
     *
     * @param $contactId Integer id of the desired contact
     * @return array response data
     */
    public function getContactById(int $contactId): array
    {
        $result = $this->contactQueries->findContactById($this->PDO, $contactId);
        return $this->responseFactory->createResponse("200", $result);
    }

    /**
     * Calls ContactQueries getAllContacts method, calls responseFactory's
     * createResponse method with 200 status and result as body.
     *
     * @return array response data
     */
    public function getAllContacts(): array
    {
        $result = $this->contactQueries->getAllContacts($this->PDO);
        return $this->responseFactory->createResponse("200", $result);
    }

    /**
     * Calls ContactQueries createNewContact method, calls responseFactory's
     * createResponse method with 200 status and result as body.
     *
     * @param $input array associative array containing user input
     * @return array response data
     */
    public function createContact(array $input): array
    {
        $result = $this->contactQueries->createNewContact($this->PDO, $input);
        return $this->responseFactory->createResponse("200", (array)$result);
    }

    /**
     * Calls ContactQueries updateContact method, calls responseFactory's
     * createResponse method with 200 status and result as body.
     *
     * @param int $contactId id of the contact to be updated
     * @param $input array associative array containing user input
     * @return array response data
     */
    public function updateContact(int $contactId, array $input): array
    {
        $this->contactQueries->updateContact($this->PDO, $input, $contactId);
        return $this->responseFactory->createResponse("200", (array)$contactId);
    }
}