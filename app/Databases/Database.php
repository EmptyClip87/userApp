<?php

namespace app\Databases;

use app\Enums\NamespacePaths;
use app\Models\User;

/**
 * Class Database
 * Factory class for database classes.
 *
 * @property $database
 */
class Database implements IDatabaseHandler
{
    private static $database;

    private function __construct() {}

    public static function getInstance()
    {
        $config = parse_ini_file('../config/config.ini');

        $class = NamespacePaths::DATABASES_PATH . $config['type'] . "Service";
        self::$database = new $class($config);

        return self::$database;
    }

    public function connect()
    {
        self::$database->connect();
    }

    public function close()
    {
        self::$database->close();
    }

    public function register(User $newUser)
    {
        self::$database->register($newUser);
    }
}