<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");



class subjectController extends DatabaseConnection
{
    // tables in databse
    private $direction = "subject";
    private $direction2 = "group_subject";
    private $direction3 = "user_group";
    private $direction4 = "user";
    private $direction5 = "teacher_subject";


    /**
     * take user subjects
     * 
     * @param int $user_id
     */ 
    public function getUserSubjects($user_id)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT
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

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Add new subject
     * 
     * @param int $order
     * @param string $short short name
     * @param string $name
     */ 
    public function addNewSubject($order, $short, $name)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("INSERT INTO $this->direction VALUES (null, :order, :name, :short_name);");
            
                $sql->bindValue(":order", $order, PDO::PARAM_INT);
                $sql->bindValue(":name", htmlentities($name), PDO::PARAM_STR);
                $sql->bindValue(":short_name", htmlentities($short), PDO::PARAM_STR);
                $sql->execute();
    
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Get all subjects
     */
    public function getSubjects()
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM $this->direction ORDER BY `order` ASC;");
                $sql->execute();

                $results = $sql->fetchAll();

            } catch (\Throwable $th) {
                return false;
            }
        }
    }


    /**
     * Get subject by id
     * 
     * @param int $subject_id
     */
    public function getSubjectByID($subject_id)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM $this->direction WHERE id = :id");
                $sql->bindValue(":id", $subject_id, PDO::PARAM_INT);
                $sql->execute();

                $result = $sql->fetch();

                return $result;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Update subject row
     */
    public function updateSubject($id, $order, $short, $name)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("UPDATE $this->direction 
                            SET `order` = :order, 
                            name = :name, 
                            short_name = :short_name 
                            WHERE id = :idsubject");

                $sql->bindValue(":idsubject", $id, PDO::PARAM_INT);
                $sql->bindValue(":order", $order, PDO::PARAM_INT);       
                $sql->bindValue(":name", htmlentities($name), PDO::PARAM_STR);
                $sql->bindValue(":short_name", htmlentities( $short), PDO::PARAM_STR);
                $sql->execute();

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Add new subject for teacher
     */
    public function addNewTeacherSubject($teacherID, $subjectID)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("INSERT INTO $this->direction5 VALUES (null, :subjectid, :teacherid);");

                $sql->bindValue(":teacherid", $teacherID, PDO::PARAM_INT);
                $sql->bindValue(":subjectid", $subjectID, PDO::PARAM_INT);
                $sql->execute();

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * check if exist
     */
    public function checkForTeacherSubject($teacherID, $subjectID)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM $this->direction5 WHERE subject_id = :subjectid AND teacher_id = :teacherid;");
                                
                $sql->bindValue(":teacherid", $teacherID, PDO::PARAM_INT);
                $sql->bindValue(":subjectid", $subjectID, PDO::PARAM_INT);
                $sql->execute();

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Get all subjects for all teachers
     */
    public function getTeachersSubjects()
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT 
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
                $results = $sql->fetchAll();
 
                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }


    /**
     * Get teacher subjects
     * 
     * @param int $teacherID
     */
    public function getTeacherSubjects($teacherID)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT ts.subject_id AS id, ts.teacher_id, s.name 
                            FROM `teacher_subject` AS ts 
                            INNER JOIN `subject` AS s ON ts.subject_id = s.id
                            AND ts.teacher_id = :teacherid");

                $sql->bindValue(":teacherid", $teacherID, PDO::PARAM_INT);
                $sql->execute();

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }


    /**
     * delete subject row/rows
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

    /**
     * Delete teacher subjects
     * 
     * @param array<int> $rows_id
     */
    public function deleteTeacherSubjects($rows_id)
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



    // return table name
    public function returnTableName()
    {
        return $this->direction;
    }

}

?>