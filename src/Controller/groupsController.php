<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");

class groupsController extends DatabaseConnection
{
    // table names in database
    private $direction  = "group";
    private $direction2 = "class";
    private $direction3 = "direction";
    private $direction4 = "user_group";
    private $direction5 = "group_subject";


    /**
     * Get all groups from database 
     * +class data and direction data
     */
    public function getGroups()
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT g.*, 
                                c.id AS school_year_id, 
                                c.number AS school_year_number, 
                                c.name AS school_year_name, 
                                d.name AS direction_name 
                                
                                FROM `group` AS g 
                                INNER JOIN class AS c ON g.class_number = c.id 
                                INNER JOIN direction AS d ON d.id = g.direction_id 
                                ORDER BY c.number DESC, g.group ASC");
                $sql->execute();

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }


    /**
     * Get group Users
     * 
     * @param int $id group id
     */
    public function getGroupUsers($id)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT ug.*, 

                            u.id AS userid,
                            u.name,
                            u.surname,
                            u.school_role,
                            u.PIN
                        
                            FROM `user_group` AS ug
                            INNER JOIN `user` AS u ON ug.student_id = u.id
                            AND ug.group_id = :id");
                                

                $sql->bindValue(":id", $id, PDO::PARAM_INT);
                $sql->execute();

                $results = $sql->fetchAll();
                
                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        } 
    }


    /**
     * Get group subjects
     * 
     * @param int $id group id
     */
    public function getGroupSubjects($id)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT s.id,
                                s.order, 
                                s.short_name, 
                                s.name 
                                FROM `group_subject` AS gs 
                                INNER JOIN `subject` AS s ON gs.subject_id = s.id 
                                AND gs.group_id = :id 
                                ORDER BY s.order ASC");
                                

                $sql->bindValue(":id", $id, PDO::PARAM_INT);
                $sql->execute();

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        } 
    }


    /**
     * Get all users without group 
     */
    public function getAllUsersWithoutGroup()
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT u.id AS `user_id`, u.name, u.surname, u.PIN, u.school_role, ug.student_id, ug.group_id FROM `user` AS u 
                            LEFT JOIN `user_group` AS ug ON u.id = ug.student_id
                            WHERE u.school_role = 'STUDENT' AND student_id IS NULL");
                                
                $sql->execute();

                $results = $sql->fetchAll();
                
                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Add user to group
     * 
     * @param int $groupID 
     * @param int 
     */
    public function addUserToGroup($groupID, $userID)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("INSERT INTO $this->direction4 VALUES (null, :userID, :groupid);");
         
                $sql->bindValue(":groupid", $groupID, PDO::PARAM_INT);
                $sql->bindValue(":userID", $userID, PDO::PARAM_INT);
                $sql->execute();
                

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }   
    }


    /**
     * Delete subject/subjects from group
     * 
     * @param array<int> $rows_id
     */
    public function deleteGroupSubjects($rows_id)
    {
        if($this->db)
        {
            try {
                foreach ($rows_id as $key => $value) 
                {
                    $sql = $this->db->prepare("DELETE FROM $this->direction5 WHERE id = :id");
            
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
     * Get all subjects
     * 
     * @param int $id group id
     */
    public function getSubjectsForGroup($id)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT s.*, 
                                gs.group_id, 
                                gs.subject_id 
                                FROM `subject` AS s 
                                LEFT JOIN `group_subject` AS gs ON gs.subject_id = s.id 
                                AND gs.group_id = :id");
                                
                $sql->bindValue(":id", $id, PDO::PARAM_INT);
                $sql->execute();

                $results = $sql->fetchAll();
                
                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }


    /**
     * Add subject to group
     * 
     * @param int $groupID
     * @param int $subjectID
     */ 
    public function addSubjectToGroup($groupId, $subjectId)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("INSERT INTO $this->direction5 VALUES (null, :groupid, :subjectid);");
         
                $sql->bindValue(":groupid", $groupId, PDO::PARAM_INT);
                $sql->bindValue(":subjectid", $subjectId, PDO::PARAM_INT);
                $sql->execute();

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }   
    }

    /**
     * Check if group exist
     * 
     * @param string $name group name
     * @param int $number
     * @param int @classNumber
     * @param int DirectionID
     */
    public function checkForGroup($name, $number, $classNumber, $directionID)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM `group` 
                            WHERE name = :g_name 
                            AND `group` = :g_number
                            AND class_number = :classnumber 
                            AND direction_id = :directionid");
                                
                $sql->bindValue(":g_name", htmlentities($name), PDO::PARAM_STR);
                $sql->bindValue(":g_number", $number, PDO::PARAM_INT);
                $sql->bindValue(":classnumber", $classNumber, PDO::PARAM_INT);
                $sql->bindValue(":directionid", $directionID, PDO::PARAM_INT);
                $sql->execute();

                $results = $sql->fetchAll();
                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }


    /**
     * Update group data
     */
    public function updateGroup($id, $name, $number, $classNumber, $directionid)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("UPDATE `group` SET 
                            name = :namegroup, 
                            `group` = :groupnumber, 
                            class_number = :classnumber, 
                            direction_id = :directionid 
                            WHERE id = :idgroup");
                                
                $sql->bindValue(":idgroup", $id, PDO::PARAM_INT);
                $sql->bindValue(":namegroup", htmlentities($name), PDO::PARAM_STR);
                $sql->bindValue(":groupnumber", $number, PDO::PARAM_INT);
                $sql->bindValue(":classnumber", $classNumber, PDO::PARAM_INT);
                $sql->bindValue(":directionid", $directionid, PDO::PARAM_INT);
                $sql->execute();

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }


    /**
     * Add new group
     * 
     * @param string $name
     * @param int $number
     * @param int $classNumber
     * @param int $directionID
     */
    public function addNewGroup($name, $number, $classNumber, $directionID)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("INSERT INTO `$this->direction` VALUES (null, :g_name, :g_number, :classnumber, :directionid);");
                $sql->bindValue(":g_name", $name, PDO::PARAM_STR);
                $sql->bindValue(":g_number", $number, PDO::PARAM_INT);
                $sql->bindValue(":classnumber", $classNumber, PDO::PARAM_INT);
                $sql->bindValue(":directionid", $directionID, PDO::PARAM_INT);
                $sql->execute();

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * delete group row/rows
     * 
     * @param int $rows_id
     */
    public function deleteRows($rows_id)
    {
        if($this->db)
        {
            try {
                foreach ($rows_id as $key => $value) 
                {
                    $rows_id = (int)$rows_id;
                    $sql = "DELETE FROM `$this->direction` WHERE id = $id";
            
                    $this->db->exec($sql);
                }

                return true;
            } catch (\Throwable $th) {
                return false;
            }

        }
    }


    /**
     * delete user from group
     * 
     * @param int $rows_id
     */
    public function deleteUserFromGroup($rows_id)
    {
        if($this->db)
        {
            try {
                foreach ($rows_id as $key => $value) 
                {
                    $value = (int) $value;
                    $sql = "DELETE FROM $this->direction4 WHERE id = $value";
                    
                    $this->db->exec($sql);
                }

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
                $sql = $this->db->prepare("SELECT * FROM `$this->direction` WHERE id = :id;");
        
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
     * Return user group name 
     * 
     * @param int $userid
     */ 
    public function returnGroupName($userid)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT g.name FROM `group` AS g 
                            INNER JOIN user_group AS ug ON g.id = ug.group_id
                            AND ug.student_id = :userid");
        
                $sql->bindValue(":userid", $userid, PDO::PARAM_INT);
                $sql->execute();

                $result = $sql->fetch();
                
                return $result;
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