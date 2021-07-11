<?php

class SettingRepository
{
    private $connection;

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

    public function Update($txt, $view) //
    {
        $this->connection->exec("UPDATE setting SET view = '$view' WHERE txt = '$txt'");
    }

    public function count() //
    {
        $result = $this->connection->prepare("SELECT count(*) FROM setting");
        $result->execute();
        return $result->fetchColumn();
    }

    public function selectViewCurrency() //
    {
        $conn = $this->connection;
        $sth = $conn->query("SELECT view, txt FROM setting WHERE view='checked'");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
        }
}