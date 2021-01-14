<?php


namespace src\Database\Connection;
require "src/Exception/DatabaseException.php";

use PDO;
use PDOException;
use src\Exception\DatabaseException;

/**
 * Class Connection
 *
 * Connection class is responsible for creating a new instance of PDO
 * from the provided connection data.
 *
 * @package Database\Connection
 */
class Connection
{
    private ?PDO $dbConnection = null;

    /**
     * Connection constructor.
     *
     * Creates a new PDO instance representing a connection to a database.
     *
     * @throws DatabaseException when connecting to the database fails.
     */
    public function __construct()
    {
        $database = getenv('DB_DATABASE');
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');

        try {
            $this->dbConnection = new PDO("mysql:host=" . $host . ";port=" . $port . ";dbname=" . $database, $username, $password);
        } catch (PDOException $exception) {
            $errorMessage = "Error while trying to connect to database!";
            throw new DatabaseException($errorMessage);
        }
    }

    /**
     * Returns the PDO instance created in the constructor method.
     *
     * @return PDO|null
     */
    public function getConnection(): ?PDO
    {
        return $this->dbConnection;
    }
}