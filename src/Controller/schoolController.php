<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__). "/../Entity/databaseConnect.php");
// include src/Manager/sessionManager
require_once(dirname(__FILE__). "/../Manager/sessionManager.php");


class schoolController
{
    // table in database
    private $school = "szkola_informacje";

    public function schoolInformation($param = 0)
    {
        $thing = "*";
        if($param !== 0)
        {
            // ex. school name
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
            $sql = $db->prepare("SELECT $thing FROM $this->school;");
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