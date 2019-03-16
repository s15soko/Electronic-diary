<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");


class classController extends DatabaseConnection
{
    // table name in database
    private $direction = "class";

    /**
     * Get all classes from database
     */
    public function getClasses()
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM $this->direction ORDER BY `number` ASC;");
                $sql->execute();

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) 
            {
                return false;
            }
        }
        
    }

    /**
     * add new class
     * 
     * @param int $number
     * @param string $name
     */
    public function addNewClass($number, $name)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("INSERT INTO $this->direction VALUES (null, :number, :name);");
            
                $sql->bindValue(":number", (int)$number, PDO::PARAM_INT);
                $sql->bindValue(":name", htmlentities($name), PDO::PARAM_STR);
                $sql->execute();

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Return values via id
     * 
     * @param int $id 
     */
    public function returnRow($id)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM $this->direction WHERE id = :id");
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
     * delete class row/rows
     * 
     * @param array<int> $rows_id
     */
    public function deleteRows($rows_id)
    {
        if($this->db)
        {
            try {
                // foreach sql
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

    /**
     * Update class data
     * 
     * @param int $id
     * @param int $number
     * @param string $name
     */
    public function updateClass($id, $number, $name)
    {
        if($this->db)
        {
            try {
                // sql
                $sql = $this->db->prepare("UPDATE $this->direction SET `number` = :numberclass, `name` = :nameclass WHERE id = :idclass");
                $sql->bindValue(":idclass", $id, PDO::PARAM_INT);
                $sql->bindValue(":numberclass", $number, PDO::PARAM_INT);
                $sql->bindValue(":nameclass", htmlentities($name), PDO::PARAM_STR);
                $sql->execute();

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Return table name
     */
    public function returnTableName()
    {
        return $this->direction;
    }
}



?>