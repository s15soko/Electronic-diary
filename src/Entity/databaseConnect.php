<?php

function get_database()
{
    $mysql_host = 'localhost';
    $database = 'dziennikelektryczny';
    $dbusername = 'root';
    $dbpassword = '';

    $charset = "utf8";

    try
    {
        $conn = new PDO("mysql:host=$mysql_host;dbname=$database;charset=$charset", $dbusername, $dbpassword);
        // zapytanie nie wykonuje biblioteka PDO tylko mysql
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // Error reporting
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $conn;
    }
    catch(PDOException $ex)
    {
        //return $ex->getMessage();
        return false;
    }
    
}

?>