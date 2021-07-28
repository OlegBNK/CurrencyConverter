<?php

//namespace Repository;

require_once("Model/History.php");
require_once ('Service/DatabaseConnection.php');

class HistoryRepository
{
    private $connection;
    public $countSelectHistory = 10;

    public function __construct()
    {
       $this->connection = DatabaseConnection::get_PDO();
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

    public function set_count_select_history($count_from_post)
    {
        $this->countSelectHistory = $count_from_post;
    }

    /**
     * @return History[]
     */
    public function select_all() : array
    {
        $arrayHistory = [];
        $conn = $this->connection;
        $sth = $conn->query("SELECT * FROM history ORDER BY id DESC LIMIT $this->countSelectHistory;");
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