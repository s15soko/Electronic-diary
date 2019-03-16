<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__). "/../Entity/databaseConnect.php");

class schoolController extends DatabaseConnection
{
    // table in database
    private $school = "school";

    // return data 
    public function schoolInformation($param = 0)
    {
        if($this->db)
        {
            $thing = "*";
            if($param !== 0)
            {
                // ex. school name
                $thing = $param;
            }
            try {
                $sql = $this->db->prepare("SELECT $thing FROM $this->school;");
                $sql->execute();

                $result = $sql->fetch();

                return $result;
            } catch (\Throwable $th) {
                return false;
            }
        }  
    }
}
?>