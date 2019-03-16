<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");



class schoolYearController extends DatabaseConnection
{
    // table name in database
    private $direction = "school_year";

    /**
     * return all rows (all school years)
     */
    public function returnAllschoolYears()
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM $this->direction;");
                $sql->execute();

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * get school year by id
     * 
     * @param int $schoolYear_id
     */ 
    public function getSchoolYearByID($schoolYear_id)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM $this->direction WHERE id = :id");
                $sql->bindValue(":id", $schoolYear_id, PDO::PARAM_INT);
                $sql->execute();

                $result = $sql->fetch();

                return $result;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     *  add new school year
     */
    public function addNewSchoolYear($schoolyear, $datef, $datet)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("INSERT INTO $this->direction VALUES (null, :schoolyear, :datef, :datet);");
            
                $sql->bindValue(":schoolyear", htmlentities($schoolyear), PDO::PARAM_STR);
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
     * update school year
     * 
     * @param int $id
     */
    public function updateSchoolYear($id, $schoolYear, $datef, $datet)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("UPDATE $this->direction SET school_year = :schoolyear, date_from = :datef, date_to = :datet 
                                WHERE id = :idschoolyear");

                $sql->bindValue(":idschoolyear", $id, PDO::PARAM_INT);
                $sql->bindValue(":schoolyear", htmlentities($schoolYear), PDO::PARAM_STR);
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
     * delete school year row/rows
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
                    $sql = $this->db->prepare("DELETE FROM $this->direction WHERE id = :id");
            
                    $sql->bindValue(":id", $value, PDO::PARAM_INT);
                    $sql->execute();
                }

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