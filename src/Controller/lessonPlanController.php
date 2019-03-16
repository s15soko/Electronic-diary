<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");


class lessonPlanController extends DatabaseConnection
{
    // table name
    private $direction = "user_lesson_plan";
    private $direction2 = "teacher_lesson_plan";

    /**
     * Get lesson hours
     */
    public function getLessonHours()
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM lesson_hours");
                $sql->execute();

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Add new lesson plan for student
     * 
     * @param int $class 
     * @param int $group
     * @param string $desc
     * @param string $datef date from
     * @param string $datet date to
     * @param array $lessonplan
     */
    public function addUserLessonPlan($class, $group, $desc, $datef, $datet, $lessonplan)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("INSERT INTO $this->direction VALUES (null, :class, :group, :descr, :datef, :datet, :lessonplan);");

                $sql->bindValue(":class", $class, PDO::PARAM_INT);
                $sql->bindValue(":group", $group, PDO::PARAM_INT);
                $sql->bindValue(":descr", htmlentities($desc), PDO::PARAM_STR);
                $sql->bindValue(":datef", $datef, PDO::PARAM_STR);
                $sql->bindValue(":datet", $datet, PDO::PARAM_STR);
                $sql->bindValue(":lessonplan", htmlentities($lessonplan), PDO::PARAM_STR);
                $sql->execute();

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Add new lesson plan for teacher
     * 
     * @param int $teacherID
     * @param string $desc
     * @param string $datef date from
     * @param string $datet date to
     * @param array $lessonplan
     */
    public function addTeacherLessonPlan($teacherID, $desc, $datef, $datet, $lessonplan)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("INSERT INTO $this->direction2 VALUES (null, :teacher, :descr, :datef, :datet, :lessonplan);");

                $sql->bindValue(":teacher", $teacherID, PDO::PARAM_INT);
                $sql->bindValue(":descr", htmlentities($desc), PDO::PARAM_STR);
                $sql->bindValue(":datef", $datef, PDO::PARAM_STR);
                $sql->bindValue(":datet", $datet, PDO::PARAM_STR);
                $sql->bindValue(":lessonplan", htmlentities($lessonplan), PDO::PARAM_STR);
                $sql->execute();

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Get all lesson plans for users
     */
    public function getUserLessonPlans()
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
     * Get user lesson plan by group id and date data
     * 
     */
    public function getUserLessonPlan($datefrom, $dateto, $groupid)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM $this->direction
                                WHERE date_from <= :datefrom 
                                AND date_to >= :dateto 
                                AND group_id = :groupid");

                $sql->bindValue(":datefrom", $datefrom, PDO::PARAM_STR);
                $sql->bindValue(":dateto", $dateto, PDO::PARAM_STR);    
                $sql->bindValue(":groupid", $groupid, PDO::PARAM_INT);      
                $sql->execute();

                $result = $sql->fetch();

                return $result;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Get teacher lesson plan by teacher id and date data
     */ 
    public function getTeacherLessonPlan($teacherID, $datefrom, $dateto)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM $this->direction2
                                WHERE date_from <= :datefrom 
                                AND date_to >= :dateto 
                                AND teacher_id = :teacher_id");

                $sql->bindValue(":datefrom", $datefrom, PDO::PARAM_STR);
                $sql->bindValue(":dateto", $dateto, PDO::PARAM_STR);    
                $sql->bindValue(":teacher_id", $teacherID, PDO::PARAM_INT);      
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