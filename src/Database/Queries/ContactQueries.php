<?php

namespace src\Database\Queries;
require "src/Database/Queries/QueryTools/QueryTool.php";


use PDO;
use src\Database\Queries\QueryTools\QueryTool;

/**
 * Class ContactQueries
 *
 * Containing queries to be executed on database table contacts.
 *
 * @package src\Database\Queries
 */
class ContactQueries
{
    /**
     * Selects all data from the table where the id matches the variable id passed in as parameter.
     *
     * @param PDO|null $PDO instance of PDO
     * @param int $id id of the desired record in the database
     * @return mixed result of method queryOne from QueryTool class
     */
    public function findContactById(?PDO $PDO, int $id)
    {
        $sql = "SELECT name,
                        email,
                        phone_number,
                        address
                FROM contacts
                WHERE id = :id";
        return QueryTool::queryOne($PDO, $sql, ["id" => $id]);
    }

    /**
     * Select all records from database table contacts.
     *
     * @param PDO|null $PDO instance of PDO
     * @return array result of method queryAll from QueryTool class
     */
    public function getAllContacts(?PDO $PDO)
    {
        $sql = "SELECT name,
                        email,
                        phone_number,
                        address
                FROM contacts";
        return QueryTool::queryAll($PDO, $sql);
    }

    /**
     * Inserts data from user input into contacts database table.
     *
     * @param PDO|null $PDO instance of PDO
     * @param $input array associative array containing user input
     * @return string result of method executeReturningId from QueryTool class
     */
    public function createNewContact(?PDO $PDO, array $input)
    {
        $sql = "INSERT INTO contacts(name, email, phone_number, address)
                VALUES (:name, :email, :phoneNumber, :address)";
        return QueryTool::executeReturningId($PDO, $sql,
            ["name" => $input["name"],
                "email" => $input["email"],
                "phoneNumber" => $input["phone_number"],
                "address" => $input["address"]]);
    }

    /**
     * Updates record in contacts database table where id matches the id passed in as parameter.
     *
     * @param PDO|null $PDO instance of PDO
     * @param $input array associative array containing user input
     * @param $id integer id of the contact to be updated
     */
    public function updateContact(?PDO $PDO, array $input, int $id)
    {
        $sql = "UPDATE contacts 
                SET email = :email
                WHERE id = :id";
        QueryTool::execute($PDO, $sql, ["email" => $input["email"], "id" => $id]);
    }
}