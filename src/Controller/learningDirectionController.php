<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");


class learningDirectionController extends DatabaseConnection
{
    // table in database
    private $direction = "direction";


    /**
     * Get all directions from database
     */
    public function getLearningDirections()
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
     * Add new direction
     * 
     * @param string $name
     * @param string $short short name
     */ 
    public function addNewDirection($name, $short)
    {
        if($this->db)
        {
            try {
                // sql
                $sql = $this->db->prepare("INSERT INTO $this->direction VALUES (null, :name_dir, :short);");
                
                $sql->bindValue(":name_dir", htmlentities($name), PDO::PARAM_STR);
                $sql->bindValue(":short", htmlentities($short), PDO::PARAM_STR);
                $sql->execute();
                
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }

    }


    /**
     * return direction row via id
     * 
     * @param int $id direction id
     */
    public function returnRow($id)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM $this->direction WHERE id = :id;");
         
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
     *  update direction
     * 
     * @param int $id
     * @param string $name
     * @param string $short short name
     */ 
    public function updateDirection($id, $name, $short)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("UPDATE $this->direction SET name = :directionname, short_name = :short WHERE id = :iddirection");
                $sql->bindValue(":iddirection", $id, PDO::PARAM_INT);
                $sql->bindValue(":directionname", htmlentities($name), PDO::PARAM_STR);
                $sql->bindValue(":short", htmlentities($short), PDO::PARAM_STR);
                $sql->execute();

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }


    /**
     * delete direction row/rows
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
                    $value = (int)$value;
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
     * Return table name
     */
    public function returnTableName()
    {
        return $this->direction;
    }

}
?>