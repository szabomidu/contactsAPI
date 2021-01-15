<?php


namespace src\Database\Connection;
require "src/Exception/DatabaseException.php";
require "src/Logger/Logger.php";
require "environment.php";

use PDO;
use src\Logger\Logger;
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
        $logger = new Logger();
        try {
            $this->dbConnection = new PDO("mysql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_DATABASE'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        } catch (PDOException $exception) {
            $logger->logError("Error while trying to connect to database!");
            throw new DatabaseException("Error while trying to connect to database!");
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