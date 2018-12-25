<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");


class learningDirectionController
{
    // table in database
    private $direction = "kierunek";


    // get all directions from database
    public function getLearningDirections()
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // sql
            $sql = $db->prepare("SELECT * FROM $this->direction;");
            $sql->execute();

            // fetch results
            $results = $sql->fetchAll();
            $db = null;

            //return results
            return $results;
        } 
        catch(PDOException $er) 
        {
            //return $er->getMessage();
            return false;
        }
    }



    // add new direction to database
    public function addNewDirection($name, $short)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // sql
            $sql = $db->prepare("INSERT INTO $this->direction VALUES (null, :name_dir, :short);");
            
            $sql->bindValue(":name_dir", $name, PDO::PARAM_STR);
            $sql->bindValue(":short", $short, PDO::PARAM_STR);
            $sql->execute();
            // close connection
            $db = null;

            //return
            return true;
        } 
        catch(PDOException $er) 
        {
            //return $er->getMessage();
            return false;
        }
    }


    // return direction row via id
    public function returnRow($id)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // sql
            $sql = $db->prepare("SELECT * FROM $this->direction WHERE id = :id;");
         
            $sql->bindValue(":id", $id, PDO::PARAM_STR);
            $sql->execute();
            // close connection
            $db = null;

            // fetch result
            $result = $sql->fetch();

            //return result
            return $result;
        } 
        catch(PDOException $er) 
        {
            //return $er->getMessage();
            return false;
        }
    }

    // delete direction row/rows
    public function deleteRows($rows_id)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // foreach sql
            foreach ($rows_id as $key => $value) 
            {
                $sql = $db->prepare("DELETE FROM $this->direction WHERE id = :id");
         
                $sql->bindValue(":id", $value, PDO::PARAM_STR);
                $sql->execute();
            }
            // close connection
            $db = null;
            return true;
        } 
        catch(PDOException $er) 
        {
            //return $er->getMessage();
            return false;
        }
    }
    
    // return table name
    public function returnTableName()
    {
        return $this->direction;
    }

}
?>