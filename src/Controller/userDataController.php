<?php
require_once(dirname(__FILE__). "/../Entity/databaseConnect.php");
require_once(dirname(__FILE__). "/../Manager/sessionManager.php");

class userDataController
{
    // table in database
    private $direction = "user";



    // get all users
    public function getAllUsers()
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
            $sql = $db->prepare("SELECT * FROM $this->direction ORDER BY school_role;");
            $sql->execute();

            // fetch results
            $results = $sql->fetchAll();

            // close connection
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

    // get all teachers
    public function getAllTeachers()
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
            $sql = $db->prepare("SELECT * FROM $this->direction 
                        WHERE school_role = 'TEACHER' 
                        OR school_role = 'DIRECTOR' ORDER BY school_role");
            $sql->execute();

            // fetch results
            $results = $sql->fetchAll();

            // close connection
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

    // set as user role
    public function setAsUser($rows_id)
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
            foreach ($rows_id as $key => $id) 
            {
                $sql = $db->prepare("UPDATE $this->direction 
                        SET school_role = 'STUDENT', 
                        role = 'USER' 
                        WHERE id = :id");
                        
                $sql->bindValue(":id", $id, PDO::PARAM_INT);
                $sql->execute();
            }
            
            // close connection
            $db = null;

            //return true
            return true;
        } 
        catch(PDOException $er) 
        {
        //return $er->getMessage();
        return false;
        }
    }


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
                throw new PDOException("No connection with database!");       
            }

            // sql
            $sql = $db->prepare("SELECT $thing FROM $this->direction WHERE id = :id;");
            $sql->bindValue(":id", $_SESSION['id_user'], PDO::PARAM_INT);
            $sql->execute();

            // fetch result
            $result = $sql->fetch();

            // close connection
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


    // delete user row/rows
    public function deleteUsers($users_id)
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
            foreach ($users_id as $key => $value) 
            {
                $sql = $db->prepare("DELETE FROM $this->direction WHERE id = :id");
        
                $sql->bindValue(":id", $value, PDO::PARAM_INT);
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


}


?>