<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");



class schoolYearController
{
    // table name in database
    private $direction = "rok_szkolny";


    // return all rows (all school years)
    public function returnAllschoolYears()
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

    // get school year by id
    public function getSchoolYearByID($schoolYear_id)
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
            $sql = $db->prepare("SELECT * FROM $this->direction WHERE id = :id");
            $sql->bindValue(":id", $schoolYear_id, PDO::PARAM_INT);
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
            // return $er->getMessage();
            return false;
        }
    }


    // add new school year to database
    public function addNewSchoolYear($schoolyear, $datef, $datet)
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
            $sql = $db->prepare("INSERT INTO $this->direction VALUES (null, :schoolyear, :datef, :datet);");
            
            $sql->bindValue(":schoolyear", $schoolyear, PDO::PARAM_STR);
            $sql->bindValue(":datef", $datef, PDO::PARAM_STR);
            $sql->bindValue(":datet", $datet, PDO::PARAM_STR);
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


    // update school year row
    public function updateSchoolYear($id, $schoolYear, $datef, $datet)
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
            $sql = $db->prepare("UPDATE $this->direction SET rok_szkolny = :schoolyear, data_od = :datef, data_do = :datet WHERE id = :idschoolyear");
            $sql->bindValue(":idschoolyear", $id, PDO::PARAM_INT);
            $sql->bindValue(":schoolyear", $schoolYear, PDO::PARAM_STR);
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



    // delete school year row/rows
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

    // return table name
    public function returnTableName()
    {
        return $this->direction;
    }
}
?>