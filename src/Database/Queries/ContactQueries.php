<?php

namespace src\Database\Queries;
require "src/Database/Queries/QueryTools/QueryTool.php";


use PDO;
use src\Database\Queries\QueryTools\QueryTool;

class ContactQueries
{

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

    public function getAllContacts(?PDO $PDO)
    {
        $sql = "SELECT name,
                        email,
                        phone_number,
                        address
                FROM contacts";
        return QueryTool::queryAll($PDO, $sql);
    }

    public function createNewContact(?PDO $PDO, $input)
    {
        $sql = "INSERT INTO contacts(name, email, phone_number, address)
                VALUES (:name, :email, :phoneNumber, :address)";
        return QueryTool::executeReturningId($PDO, $sql,
            ["name" => $input["name"],
                "email" => $input["email"],
                "phoneNumber" => $input["phone_number"],
                "address" => $input["address"]]);
    }

    public function updateContact(?PDO $PDO, $input, $id)
    {
        $sql = "UPDATE contacts 
                SET email = :email
                WHERE id = :id";
        QueryTool::execute($PDO, $sql, ["email" => $input["email"], "id" => $id]);
    }
}