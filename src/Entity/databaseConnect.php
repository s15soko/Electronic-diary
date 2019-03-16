<?php

class DatabaseConnection
{
    private $mysql_host = 'localhost';
    private $database = 'electronic_diary';
    private $dbusername = 'root';
    private $dbpassword = '';
    private $charset = "utf8";

    protected $db;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=$this->mysql_host;dbname=$this->database;charset=$this->charset", $this->dbusername, $this->dbpassword);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            //$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\Throwable $th) 
        {
            $this->db = null;
        }
    }


    public function __destruct()
    {
        $this->db = null;
    }
}
?>