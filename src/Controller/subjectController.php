<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");



class subjectController
{
    // tables in databse
    private $direction = "subject";
    private $direction2 = "group_subject";
    private $direction3 = "user_group";
    private $direction4 = "user";
    private $direction5 = "teacher_subject";


    // take user subjects
    public function getUserSubjects($user_id)
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
            $sql = $db->prepare("SELECT
                                s.id,
                                s.order,
                                s.short_name,
                                s.name
                            
                                FROM `subject` AS s,
                                `group_subject` AS gs,
                                `user_group` AS ug,
                                `user` AS u
                                WHERE
                                u.id = :id_user 
                                AND ug.student_id = u.id
                                AND ug.group_id = gs.group_id
                                AND gs.subject_id = s.id
                                ORDER by s.order ASC");


            $sql->bindValue(":id_user", $user_id, PDO::PARAM_INT);
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

    // add new subject to database
    public function addNewSubject($order, $short, $name)
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
            $sql = $db->prepare("INSERT INTO $this->direction VALUES (null, :order, :name, :short_name);");
            
            $sql->bindValue(":order", $order, PDO::PARAM_INT);
            $sql->bindValue(":name", $name, PDO::PARAM_STR);
            $sql->bindValue(":short_name", $short, PDO::PARAM_STR);
            $sql->execute();

            // close connection
            $db = null;

            //return
            return true;
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
            return false;
        }
    }


    // get all subjects from database
    public function getSubjects()
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
            $sql = $db->prepare("SELECT * FROM $this->direction ORDER BY `order` ASC;");
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


    // get subject by id
    public function getSubjectByID($subject_id)
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
            $sql = $db->prepare("SELECT * FROM $this->direction WHERE id = :id");
            $sql->bindValue(":id", $subject_id, PDO::PARAM_INT);
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


    // update subject row
    public function updateSubject($id, $order, $short, $name)
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
            $sql = $db->prepare("UPDATE $this->direction 
                            SET `order` = :order, 
                            name = :name, 
                            short_name = :short_name 
                            WHERE id = :idsubject");

            $sql->bindValue(":idsubject", $id, PDO::PARAM_INT);
            $sql->bindValue(":order", $order, PDO::PARAM_INT);       
            $sql->bindValue(":name", $name, PDO::PARAM_STR);
            $sql->bindValue(":short_name", $short, PDO::PARAM_STR);
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

    // add new subject for teacher
    public function addNewTeacherSubject($teacherID, $subjectID)
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
            $sql = $db->prepare("INSERT INTO $this->direction5 VALUES (null, :subjectid, :teacherid);");

            $sql->bindValue(":teacherid", $teacherID, PDO::PARAM_INT);
            $sql->bindValue(":subjectid", $subjectID, PDO::PARAM_INT);
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

    // check if exist
    public function checkForTeacherSubject($teacherID, $subjectID)
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
            $sql = $db->prepare("SELECT * FROM $this->direction5 WHERE subject_id = :subjectid AND teacher_id = :teacherid;");
                                
            $sql->bindValue(":teacherid", $teacherID, PDO::PARAM_INT);
            $sql->bindValue(":subjectid", $subjectID, PDO::PARAM_INT);
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
            //return $er->getMessage();
            return false;
        }
    }

    // get all subjects for all teachers
    public function getTeachersSubjects()
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
            $sql = $db->prepare("SELECT 
                            ts.id,
                            ts.subject_id,
                            ts.teacher_id,
                            s.id AS sid,
                            s.order AS s_order,
                            s.short_name AS sshort_name,
                            s.name AS sname
                        
                            FROM `teacher_subject` AS ts
                            INNER JOIN `subject` AS s ON ts.subject_id = s.id");
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


    // get teacher subjects
    // by user id
    // + data from subjects table
    public function getTeacherSubjects($teacherID)
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
            $sql = $db->prepare("SELECT ts.subject_id AS id, ts.teacher_id, s.name 
                                FROM `teacher_subject` AS ts 
                                INNER JOIN `subject` AS s ON ts.subject_id = s.id
                                AND ts.teacher_id = :teacherid");
            $sql->bindValue(":teacherid", $teacherID, PDO::PARAM_INT);
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


    // delete subject row/rows
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

    // delete teacher subjects
    public function deleteTeacherSubjects($rows_id)
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