<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");


class classController
{
    // table name in database
    private $direction = "class";


    // get all classes from database
    public function getClasses()
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("No connection with database!");       
            }

            // sql
            $sql = $db->prepare("SELECT * FROM $this->direction ORDER BY `number` ASC;");
            $sql->execute();

            // fetch results
            $results = $sql->fetchAll();

            // close connection
            $db = null;

            // return results
            return $results;
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
            return false;
        }
    }


    // add new class
    public function addNewClass($number, $name)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("No connection with database!");       
            }

            // sql
            $sql = $db->prepare("INSERT INTO $this->direction VALUES (null, :number, :name);");
            
            $sql->bindValue(":number", $number, PDO::PARAM_INT);
            $sql->bindValue(":name", $name, PDO::PARAM_STR);
            $sql->execute();

            // close connection
            $db = null;

            // return true
            return true;
        } 
        catch(PDOException $er) 
        {
            //return $er->getMessage();
            return false;
        }
    }

    // return values via id
    public function returnRow($id)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("No connection with database!");       
            }

            // sql
            $sql = $db->prepare("SELECT * FROM $this->direction WHERE id = :id");
            $sql->bindValue(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            // fetch result
            $result = $sql->fetch();

            // close connection
            $db = null;

            // return result
            return $result;
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
            return false;
        }
    }

    // delete class row/rows
    public function deleteRows($rows_id)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("No connection with database!");       
            }

            // foreach sql
            foreach ($rows_id as $key => $value) 
            {
                $sql = $db->prepare("DELETE FROM $this->direction WHERE id = :id");
         
                $sql->bindValue(":id", $value, PDO::PARAM_INT);
                $sql->execute();
            }

            // close connection
            $db = null;

            // return true
            return true;
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
            return false;
        }
    }

    // update class
    public function updateClass($id, $number, $name)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("No connection with database!");       
            }

            // sql
            $sql = $db->prepare("UPDATE $this->direction SET `number` = :numberclass, `name` = :nameclass WHERE id = :idclass");
            $sql->bindValue(":idclass", $id, PDO::PARAM_INT);
            $sql->bindValue(":numberclass", $number, PDO::PARAM_INT);
            $sql->bindValue(":nameclass", $name, PDO::PARAM_STR);
            $sql->execute();

            // close connection
            $db = null;

            // return true
            return true;
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
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