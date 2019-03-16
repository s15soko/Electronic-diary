<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");

class termsController extends DatabaseConnection
{
    // table in database
    private $direction = "term";
    // second table
    private $direction2 = "school_year";


    /**
     * get all terms from database and school year 
     */
    public function getTerms()
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT t.id, 
                                sy.school_year, 
                                t.name, 
                                t.date_from, 
                                t.date_to 
                                FROM `term` AS t, `school_year` AS sy 
                                WHERE t.school_year_id = sy.id");
                $sql->execute();

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * add new term
     * 
     * @param int $year
     * @param string $term
     * 
     */ 
    public function addNewTerm($year, $term, $datef, $datet)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("INSERT INTO $this->direction VALUES (null, :yearid, :termstr, :datef, :datet);");
                $sql->bindValue(":yearid", $year, PDO::PARAM_INT);
                $sql->bindValue(":termstr", htmlentities($term), PDO::PARAM_STR);
                $sql->bindValue(":datef", htmlentities($datef), PDO::PARAM_STR);
                $sql->bindValue(":datet", htmlentities($datet), PDO::PARAM_STR);
                $sql->execute();


                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * get all terms by id
     * 
     * @param int $year_id
     */
    public function getTermsByID($year_id)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT t.id, sy.school_year, t.name, t.date_from, t.date_to 
                                    FROM `term` AS t, `school_year`AS sy 
                                    WHERE t.school_year_id = :id 
                                    AND t.school_year_id = sy.id 
                                    ORDER BY t.date_from ASC");
                $sql->bindValue(":id", $year_id, PDO::PARAM_INT);
                $sql->execute();

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }



    /**
     * delete 
     * 
     * @param array<int> $rows_id
     */
    public function deleteRows($rows_id)
    {
        if($this->db)
        {
            try {
                foreach ($rows_id as $key => $value) 
                {
                    $value = (int) $value;
                    $sql = "DELETE FROM $this->direction WHERE id = $value";
            
                    $this->db->exec($sql);
                }
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }
    
    /**
     * return values via id
     * 
     * @param int $id
     */
    public function returnRow($id)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT t.*, sy.id, sy.school_year 
                                FROM `term` AS t 
                                INNER JOIN `school_year` AS sy ON sy.id = t.school_year_id 
                                AND t.id = :id");
        
                $sql->bindValue(":id", $id, PDO::PARAM_INT);
                $sql->execute();

                $result = $sql->fetch();

                return $result;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * update term
     * 
     */
    public function updateTerm($id, $year, $term, $datef, $datet)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("UPDATE $this->direction SET school_year_id = :yearid, name = :termstr, date_from = :datef, date_to = :datet 
                                WHERE id = :idterm");
                $sql->bindValue(":idterm", $id, PDO::PARAM_INT);
                $sql->bindValue(":yearid", $year, PDO::PARAM_INT);
                $sql->bindValue(":termstr", htmlentities($term), PDO::PARAM_STR);
                $sql->bindValue(":datef", htmlentities($datef), PDO::PARAM_STR);
                $sql->bindValue(":datet", htmlentities($datet), PDO::PARAM_STR);
                $sql->execute();
                
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }


    // return table name
    public function returnTableName()
    {
        return $this->direction;
    }

}

?>