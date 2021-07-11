<?php

require_once("Model/History.php");

class HistoryRepository
{
    private $connection;
    public $countSelectHistory = 10;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "CurrencyConverter";

        $this->connection = new PDO("mysql:host=$servername; dbname=$dbname;charset=UTF8", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->connection = null;
    }

    public function add($checked_value, $checked_r030, $checked_txt, $checked_rate, $checked_cc, $checked_exchangedate, $received_value, $received_r030, $received_txt, $received_rate, $received_cc, $received_exchangedate)
    {
        $date = new \DateTime();
        $created_at = $date->format('Y-m-d H:i:s');
        $query = "INSERT INTO history (checked_value, checked_r030, checked_txt, checked_rate, checked_cc, checked_exchangedate, received_value, received_r030, received_txt, received_rate, received_cc, received_exchangedate, created_at) VALUES ('$checked_value', '$checked_r030', '$checked_txt', '$checked_rate', '$checked_cc', '$checked_exchangedate', '$received_value', '$received_r030', '$received_txt', '$received_rate', '$received_cc', '$received_exchangedate', '$created_at')";
        $this->connection->exec($query);
    }

    public function setCountSelectHistory($count_from_post)
    {
        $this->countSelectHistory = $count_from_post;
    }

    public function selectAll()
    {
        $arrayHistory = [];
        $conn = $this->connection;
        $sth = $conn->query("SELECT * FROM (SELECT * FROM history ORDER BY id DESC LIMIT $this->countSelectHistory) t ORDER BY id;");
        $sth->execute();
        $result = $sth->fetchAll();

        if (isset($result)) {
            foreach ($result as $item) {
                $arrayHistory[] = new History($item['checked_value'], $item['checked_r030'], $item['checked_txt'], $item['checked_rate'], $item['checked_cc'], $item['checked_exchangedate'], $item['received_value'], $item['received_r030'], $item['received_txt'], $item['received_rate'], $item['received_cc'], $item['received_exchangedate'], $item['created_at']);
            }
        }
        return $arrayHistory;
    }
}