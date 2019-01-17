<?php

function get_database()
{
    // database values
    $mysql_host = 'localhost';
    $database = 'electronic_diary';
    $dbusername = 'root';
    $dbpassword = '';

    $charset = "utf8";


    try
    {
        $conn = new PDO("mysql:host=$mysql_host;dbname=$database;charset=$charset", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // Error reporting
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        // return 
        return $conn;
    }
    catch(PDOException $ex)
    {
        //return $ex->getMessage();
        // return false
        // connection error
        return false;
    }
    
}

?>