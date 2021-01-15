<?php


namespace src\Database\Connection;
require "src/Exception/DatabaseException.php";
require "environment.php";

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
        $database = $_ENV['DB_DATABASE'];
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

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