<?php

namespace app\Services;

use app\Databases\IDatabaseHandler;
use app\Models\Response;
use app\Models\User;

/**
 * Class MysqlService
 * MySQL wrapper class
 *
 * @property $database   Database instance.
 * @property $host, $dbName, $username, $password, $port, $type   Database data
 */
class MysqlService implements IDatabaseHandler
{
    private $host;
    private $dbName;
    private $username;
    private $password;
    private $port;
    private $type;

    /**
     * @var $pdo \PDO
     */
    private $pdo;

    public function __construct($dbData)
    {
        $this->host = $dbData['host'];
        $this->dbName = $dbData['dbname'];
        $this->username = $dbData['username'];
        $this->password = $dbData['password'];
        $this->port = $dbData['port'];
        $this->type = $dbData['type'];
    }


    /**
     * @param User $newUser
     * @return int
     */
    public function register(User $newUser)
    {
        $stmt = $this->pdo->prepare('INSERT INTO user (name, email, password) VALUES (:name, :email, :password);');

        $stmt->bindValue(':name', $newUser->getName());
        $stmt->bindValue(':email', $newUser->getEmail());
        $stmt->bindValue(':password', $newUser->getPassword());

        if (!$stmt->execute()) {
            throw new \PDOException($stmt->errorInfo());
        }

        return $this->pdo->lastInsertId();
    }


    /**
     * Connects to a MySQL database
     */
    public function connect()
    {
        $response = new Response();

        try{
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
            $pdo = new \PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $this->pdo = $pdo;
        } catch (\PDOException $e) {
            $response->handleException($e);
        }
    }
}