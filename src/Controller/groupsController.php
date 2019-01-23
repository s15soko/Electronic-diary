<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");



class groupsController
{
    // table names in database
    private $direction  = "group";
    private $direction2 = "class";
    private $direction3 = "direction";
    private $direction4 = "user_group";
    private $direction5 = "group_subject";



    // get all groups from database 
    // +class data and direction data
    public function getGroups()
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
            $sql = $db->prepare("SELECT g.*, 
                                c.id AS school_year_id, 
                                c.number AS school_year_number, 
                                c.name AS school_year_name, 
                                d.name AS direction_name 
                                
                                FROM `group` AS g 
                                INNER JOIN class AS c ON g.class_number = c.id 
                                INNER JOIN direction AS d ON d.id = g.direction_id 
                                ORDER BY c.number DESC, g.group ASC");
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
            // return $er->getMessage();
            return false;
        }
    }


    // get group Users (by group id)
    public function getGroupUsers($id)
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
            $sql = $db->prepare("SELECT ug.*, 

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

            // fetch results
            $results = $sql->fetchAll();

            // close connection
            $db = null;
            
            //return result
            return $results;
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
            return false;
        }  
    }


    // get group subjects (by group id)
    public function getGroupSubjects($id)
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
            $sql = $db->prepare("SELECT s.id,
                                s.order, 
                                s.short_name, 
                                s.name 
                                FROM `group_subject` AS gs 
                                INNER JOIN `subject` AS s ON gs.subject_id = s.id 
                                AND gs.group_id = :id 
                                ORDER BY s.order ASC");
                                

            $sql->bindValue(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            // fetch results
            $results = $sql->fetchAll();

            // close connection
            $db = null;
            
            //return result
            return $results;
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
            return false;
        }  
    }


    // delete subject/subjects from group
    public function deleteGroupSubjects($rows_id)
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
            foreach ($rows_id as $key => $value) 
            {
                $sql = $db->prepare("DELETE FROM $this->direction5 WHERE id = :id");
         
                $sql->bindValue(":id", $value, PDO::PARAM_INT);
                $sql->execute();
            }

            // close connection
            $db = null;

            return true;
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
            return false;
        }     
    }


    // get all subjects + add data from other table
    public function getSubjectsForGroup($id)
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
            $sql = $db->prepare("SELECT s.*, 
                                gs.group_id, 
                                gs.subject_id 
                                FROM `subject` AS s 
                                LEFT JOIN `group_subject` AS gs ON gs.subject_id = s.id 
                                AND gs.group_id = :id");
                                
            $sql->bindValue(":id", $id, PDO::PARAM_INT);
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
            // return $er->getMessage();
            return false;
        }
    }


    // add subject to group
    public function addSubjectToGroup($groupId, $subjectId)
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

            $sql = $db->prepare("INSERT INTO $this->direction5 VALUES (null, :groupid, :subjectid);");
         
            $sql->bindValue(":groupid", $groupId, PDO::PARAM_INT);
            $sql->bindValue(":subjectid", $subjectId, PDO::PARAM_INT);
            $sql->execute();
            
            // close connection
            $db = null;

            return true;
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
            return false;
        }     
    }


    // check if group exist
    public function checkForGroup($name, $number, $classNumber, $directionID)
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
            $sql = $db->prepare("SELECT * FROM `group` 
                            WHERE name = :g_name 
                            AND `group` = :g_number
                            AND class_number = :classnumber 
                            AND direction_id = :directionid");
                                
            $sql->bindValue(":g_name", $name, PDO::PARAM_STR);
            $sql->bindValue(":g_number", $number, PDO::PARAM_INT);
            $sql->bindValue(":classnumber", $classNumber, PDO::PARAM_INT);
            $sql->bindValue(":directionid", $directionID, PDO::PARAM_INT);
            $sql->execute();

            // fetch results
            $results = $sql->fetchAll();

            // close connection
            $db = null;

            // return results
            return $results;
        } 
        catch(PDOException $er) 
        {
            //return $er->getMessage();
            return false;
        }
    }


    // update group data
    public function updateGroup($id, $name, $number, $classNumber, $directionid)
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
            $sql = $db->prepare("UPDATE `group` SET 
                            name = :namegroup, 
                            `group` = :groupnumber, 
                            class_number = :classnumber, 
                            direction_id = :directionid 
                            WHERE id = :idgroup");
                                
            $sql->bindValue(":idgroup", $id, PDO::PARAM_INT);
            $sql->bindValue(":namegroup", $name, PDO::PARAM_STR);
            $sql->bindValue(":groupnumber", $number, PDO::PARAM_INT);
            $sql->bindValue(":classnumber", $classNumber, PDO::PARAM_INT);
            $sql->bindValue(":directionid", $directionid, PDO::PARAM_INT);
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


    // add new group
    public function addNewGroup($name, $number, $classNumber, $directionID)
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
            $sql = $db->prepare("INSERT INTO `$this->direction` VALUES (null, :g_name, :g_number, :classnumber, :directionid);");
            $sql->bindValue(":g_name", $name, PDO::PARAM_STR);
            $sql->bindValue(":g_number", $number, PDO::PARAM_INT);
            $sql->bindValue(":classnumber", $classNumber, PDO::PARAM_INT);
            $sql->bindValue(":directionid", $directionID, PDO::PARAM_INT);
            $sql->execute();

            // close connection
            $db = null;

            return true;
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
            return false;
        }
    }


    // delete group row/rows
    // delete by id
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

            // foreach sql
            foreach ($rows_id as $key => $value) 
            {
                $sql = $db->prepare("DELETE FROM `$this->direction` WHERE id = :id");
         
                $sql->bindValue(":id", $value, PDO::PARAM_INT);
                $sql->execute();
            }

            // close connection
            $db = null;

            return true;
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
            return false;
        }
    }


    // delete user from group
    // delete by row id
    public function deleteUserFromGroup($rows_id)
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
            foreach ($rows_id as $key => $value) 
            {
                $sql = $db->prepare("DELETE FROM $this->direction4 WHERE id = :id");
         
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
    // ex. for edit pages
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
            $sql = $db->prepare("SELECT * FROM `$this->direction` WHERE id = :id;");
        
            $sql->bindValue(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            // fetch result
            $result = $sql->fetch();

            // close connection
            $db = null;

            // return result
            return $result;
        } 
        catch(PDOException $er) 
        {
            //return $er->getMessage();
            return false;
        }
    }

    // return user group name
    public function returnGroupName($userid)
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
            $sql = $db->prepare("SELECT g.name FROM `group` AS g 
                            INNER JOIN user_group AS ug ON g.id = ug.group_id
                            AND ug.student_id = :userid");
        
            $sql->bindValue(":userid", $userid, PDO::PARAM_INT);
            $sql->execute();

            // fetch result
            $result = $sql->fetch();

            // close connection
            $db = null;

            // return result
            return $result;
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