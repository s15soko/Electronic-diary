<?php
require_once(dirname(__FILE__). "/../Entity/databaseConnect.php");
require_once(dirname(__FILE__). "/../Manager/sessionManager.php");

class userDataController
{
    // table in database
    private $direction = "uzytkownik";

    // get user data
    public function getUserData($param = 0)
    {
        $thing = "*";
        if($param !== 0)
        {
            // $thing = $param ex. "imie"
            $thing = $param;
        }
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // sql
            $sql = $db->prepare("SELECT $thing FROM $this->direction WHERE id = :id;");
            $sql->bindValue(":id", $_SESSION['id_user'], PDO::PARAM_STR);
            $sql->execute();

            // fetch result
            $result = $sql->fetch();
            $db = null;

            //return result
            return $result;
            
        } 
        catch(PDOException $er) 
        {
            //return $er->getMessage();
            return false;
        }
    }
}









?>