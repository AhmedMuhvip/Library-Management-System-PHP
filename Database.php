<?php


class Database
{
    public PDO $db;
    protected string $servername = "localhost"; // Fixed typo
    protected string $username = "root";
    protected string $password = "root";
    protected string $dbname = "LibraryManagementSystem";

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: ".$e->getMessage();
            die("Database connection failed");
        }
    }
}
