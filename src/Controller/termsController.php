<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");

class termsController
{
    // table in database
    private $direction = "semestr";
    // second table
    private $direction2 = "rok_szkolny";


    // get all terms from database and school year 
    public function getTerms()
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
            $sql = $db->prepare("SELECT s.id, r.rok_szkolny, s.semestr, s.data_od, s.data_do 
                            FROM $this->direction as s, $this->direction2 as r
                            WHERE s.rok_szkolny = r.id;");
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
                throw new PDOException("Brak polaczenia z baza!");       
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
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // sql
            $sql = $db->prepare("SELECT s.id, r.rok_szkolny, s.semestr, s.data_od, s.data_do 
            FROM $this->direction as s, $this->direction2 as r
            WHERE s.rok_szkolny = :id
            AND s.rok_szkolny = r.id ORDER BY s.data_od ASC");
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
                throw new PDOException("Brak polaczenia z baza!");       
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
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // sql
            $sql = $db->prepare("SELECT s.*, rs.id, rs.rok_szkolny FROM semestr AS s 
                                INNER JOIN rok_szkolny AS rs 
                                ON rs.id = s.rok_szkolny AND s.id = :id");
        
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
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // sql
            $sql = $db->prepare("UPDATE $this->direction SET rok_szkolny = :yearid, semestr = :termstr, data_od = :datef, data_do = :datet WHERE id = :idterm");
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