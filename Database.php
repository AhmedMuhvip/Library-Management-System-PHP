<?php
class Database
{
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "LibraryManagementSystem";
    protected $conn;
 public function __construct()
 {
     try {

      $db=new PDO("mysql:host=$this->servername;dbname=$this->dbname",$this->username,$this->password='root');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "Connected Successfully";
     }catch (PDOException $e){
         echo "Connection failed: ".$e->getMessage();
     }
 }
}

