<?php


class DatabaseConnection
{
    /**
     * @var self // док блок
     */
    private static $instance;
    /**
     * @var PDO
     */
    private $connection;

    private function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "CurrencyConverter";

        $this->connection = new PDO("mysql:host=$servername; dbname=$dbname;charset=UTF8", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function get_PDO(): PDO
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance->connection;
    }

}