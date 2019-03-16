<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");


class marksController extends DatabaseConnection
{
    // table name in database
    private $direction = "grade";
    private $direction2 = "grade_scale";
    private $direction3 = "grade_type";


    /**
     * Find all user marks by term id
     */
    public function getUserMarksByTermID($term_id, $user_id)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT g.*, gs.*, gt.* 
                                    FROM `grade` AS g 
                                    INNER JOIN `grade_scale` AS gs 
                                    ON g.grade = gs.id 
                                    AND g.student_id = :iduser 
                                    AND g.term_id = :idterm
                                    INNER JOIN `grade_type` AS gt 
                                    ON g.type = gt.id 
                                    ORDER BY g.date DESC");

                $sql->bindValue(":iduser", $user_id, PDO::PARAM_INT);
                $sql->bindValue(":idterm", $term_id, PDO::PARAM_INT);
                $sql->execute();

                $results = $sql->fetchAll();
     
                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Add new grade
     */ 
    public function addNewGrade($users, $teacherID, $schoolYearID, $termID, $subjectID, $gradeWeight, $gradeRange, $gradeTypeID, $gradeID)
    {
        if($this->db)
        {
            try {
                foreach ($users as $user) 
                {
                    $sql = $this->db->prepare("INSERT INTO $this->direction VALUES 
                                        (NULL, :grade, :gweight, :grange, :gtype, :gdate, :student_id, :teacher_id, :subject_id, :term_id, :schoolyear_id)");
                                        
                    if($gradeWeight > 100) $gradeWeight = 100;

                    $sql->bindValue(":grade", $gradeID, PDO::PARAM_INT);
                    $sql->bindValue(":gweight", $gradeWeight, PDO::PARAM_INT);
                    $sql->bindValue(":grange", htmlentities($gradeRange), PDO::PARAM_STR);
                    $sql->bindValue(":gtype", $gradeTypeID, PDO::PARAM_INT);
                    $sql->bindValue(":gdate", htmlentities(date("Y-m-d")), PDO::PARAM_STR);
                    $sql->bindValue(":student_id", $user, PDO::PARAM_INT);
                    $sql->bindValue(":teacher_id", $teacherID, PDO::PARAM_INT);
                    $sql->bindValue(":subject_id", $subjectID, PDO::PARAM_INT);
                    $sql->bindValue(":term_id", $termID, PDO::PARAM_INT);
                    $sql->bindValue(":schoolyear_id", $schoolYearID, PDO::PARAM_INT);

                    $sql->execute();
                }

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }    
    }

    /**
     * Get all grade types
     */
    public function getGradeTypes()
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM $this->direction3");
                $sql->execute();
                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Get all grades scale
     */ 
    public function getGradesScale()
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM $this->direction2");
                $sql->execute();

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Get USERS marks by term id, subject id
     * 
     * @param int $term_id
     * @param int $subject_id
     */
    public function getUsersMarksByTermIDSubjectID($term_id, $subject_id)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT g.*, gs.grade AS user_grade FROM $this->direction AS g 
                            INNER JOIN grade_scale AS gs ON gs.id = g.grade
                            AND g.term_id = :term_id
                            AND g.subject_id = :subject_id");
                $sql->bindValue(":term_id", $term_id, PDO::PARAM_INT);
                $sql->bindValue(":subject_id", $subject_id, PDO::PARAM_INT);
                $sql->execute();

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }
}
?>
