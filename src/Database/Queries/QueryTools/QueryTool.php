<?php


namespace src\Database\Queries\QueryTools;

use PDO;

/**
 * Class QueryTool
 *
 * QueryTool's task is to abstract away details of database operation.
 * Consists of three methods, each representing a common option of executing
 * SQL statements.
 *
 * @package Database\Queries\QueryTools
 */
class QueryTool
{
    /**
     * Execute SQL statement with returning the last inserted ID.
     *
     * @param PDO $pdo PDO instance
     * @param string $sqlStatement desired query (SQL statement) in string format
     * @param array $variables variables to place into the prepared statement (associative array)
     * @return string
     */
    public static function executeReturningId(PDO $pdo, string $sqlStatement, array $variables = array())
    {
        $preparedStatement = $pdo->prepare($sqlStatement);
        $preparedStatement->execute($variables);
        return $pdo->lastInsertId();
    }


    /**
     * Execute SQL statement without returning any data.
     *
     * @param PDO $pdo PDO instance
     * @param string $sqlStatement desired query (SQL statement) in string format
     * @param array $variables variables to place into the prepared statement (associative array)
     */
    public static function execute(PDO $pdo, string $sqlStatement, array $variables = array())
    {
        $preparedStatement = $pdo->prepare($sqlStatement);
        $preparedStatement->execute($variables);
    }

    /**
     * Execute SQL statement, returning multiple records.
     *
     * @param PDO $pdo PDO instance
     * @param string $sqlStatement desired query (SQL statement) in string format
     * @param array $variables variables to place into the prepared statement (associative array)
     * @return array
     */
    public static function queryAll(PDO $pdo, string $sqlStatement, array $variables = array())
    {
        $preparedStatement = $pdo->prepare($sqlStatement);
        $preparedStatement->execute($variables);
        return $preparedStatement->fetchAll();
    }

    /**
     * Execute SQL statement, returning single records.
     *
     * @param PDO $pdo PDO instance
     * @param string $sqlStatement desired query (SQL statement) in string format
     * @param array $variables variables to place into the prepared statement (associative array)
     * @return mixed
     */
    public static function queryOne(PDO $pdo, string $sqlStatement, array $variables = array())
    {
        $preparedStatement = $pdo->prepare($sqlStatement);
        $preparedStatement->execute($variables);
        return $preparedStatement->fetch();
    }
}