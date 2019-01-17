<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");

class termsController
{
    // table in database
    private $direction = "term";
    // second table
    private $direction2 = "school_year";


    // get all terms from database and school year 
    public function getTerms()
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
            $sql = $db->prepare("SELECT t.id, 
                                sy.school_year, 
                                t.name, 
                                t.date_from, 
                                t.date_to 
                                FROM `term` AS t, `school_year` AS sy 
                                WHERE t.school_year_id = sy.id");
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

    // add new term
    public function addNewTerm($year, $term, $datef, $datet)
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
            $sql = $db->prepare("INSERT INTO $this->direction VALUES (null, :yearid, :termstr, :datef, :datet);");
            $sql->bindValue(":yearid", $year, PDO::PARAM_INT);
            $sql->bindValue(":termstr", $term, PDO::PARAM_STR);
            $sql->bindValue(":datef", $datef, PDO::PARAM_STR);
            $sql->bindValue(":datet", $datet, PDO::PARAM_STR);
            $sql->execute();

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

    // get all terms by id
    public function getTermsByID($year_id)
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
            $sql = $db->prepare("SELECT t.id, sy.school_year, t.name, t.date_from, t.date_to 
                                    FROM `term` AS t, `school_year`AS sy 
                                    WHERE t.school_year_id = :id 
                                    AND t.school_year_id = sy.id 
                                    ORDER BY t.date_from ASC");
            $sql->bindValue(":id", $year_id, PDO::PARAM_INT);
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



    // delete 
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

            // sql
            foreach ($rows_id as $key => $value) 
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
            $sql = $db->prepare("SELECT t.*, sy.id, sy.school_year 
                                FROM `term` AS t 
                                INNER JOIN `school_year` AS sy ON sy.id = t.school_year_id 
                                AND t.id = :id");
        
            $sql->bindValue(":id", $id, PDO::PARAM_INT);
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

    // update term
    public function updateTerm($id, $year, $term, $datef, $datet)
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
            $sql = $db->prepare("UPDATE $this->direction SET school_year_id = :yearid, name = :termstr, date_from = :datef, date_to = :datet 
                                WHERE id = :idterm");
            $sql->bindValue(":idterm", $id, PDO::PARAM_INT);
            $sql->bindValue(":yearid", $year, PDO::PARAM_INT);
            $sql->bindValue(":termstr", $term, PDO::PARAM_STR);
            $sql->bindValue(":datef", $datef, PDO::PARAM_STR);
            $sql->bindValue(":datet", $datet, PDO::PARAM_STR);
            $sql->execute();
            
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