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
}