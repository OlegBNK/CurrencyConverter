<?php

require_once ('Service/DatabaseConnection.php');

class SettingRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = DatabaseConnection::get_PDO();
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->connection = null;
    }

    public function add($txt, $view) //
    {
        $query = "INSERT INTO setting (view, txt) VALUES ('$view','$txt')";
        $this->connection->exec($query);
    }

    public function Delete()
    {
        // не используется
        $sql = "DELETE FROM setting";
        $this->connection->exec($sql);
    }

    public function update($txt, $view) //
    {
        $this->connection->exec("UPDATE setting SET view = '$view' WHERE txt = '$txt'");
    }

    public function count() //
    {
        $result = $this->connection->prepare("SELECT count(*) FROM setting");
        $result->execute();
        return $result->fetchColumn();
    }

    public function select_view_currency(): array
    {
        $conn = $this->connection;
        $sth = $conn->query("SELECT txt FROM setting WHERE view='checked'");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function (array $currencySetting) {
            return $currencySetting['txt'];
        }, $result);
    }
}