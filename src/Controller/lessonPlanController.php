<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");


class lessonPlanController
{
    // table name
    private $direction = "user_lesson_plan";
    private $direction2 = "teacher_lesson_plan";

    // get lesson hours
    public function getLessonHours()
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("No connection with database!");       
            }

            $sql = $db->prepare("SELECT * FROM lesson_hours");
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

    // add new lesson plan for student
    public function addUserLessonPlan($class, $group, $desc, $datef, $datet, $lessonplan)
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
            $sql = $db->prepare("INSERT INTO $this->direction VALUES (null, :class, :group, :descr, :datef, :datet, :lessonplan);");

            $sql->bindValue(":class", $class, PDO::PARAM_INT);
            $sql->bindValue(":group", $group, PDO::PARAM_INT);
            $sql->bindValue(":descr", $desc, PDO::PARAM_STR);
            $sql->bindValue(":datef", $datef, PDO::PARAM_STR);
            $sql->bindValue(":datet", $datet, PDO::PARAM_STR);
            $sql->bindValue(":lessonplan", $lessonplan, PDO::PARAM_STR);
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

    // add new lesson plan for teacher
    public function addTeacherLessonPlan($teacherID, $desc, $datef, $datet, $lessonplan)
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
            $sql = $db->prepare("INSERT INTO $this->direction2 VALUES (null, :teacher, :descr, :datef, :datet, :lessonplan);");

            $sql->bindValue(":teacher", $teacherID, PDO::PARAM_INT);
            $sql->bindValue(":descr", $desc, PDO::PARAM_STR);
            $sql->bindValue(":datef", $datef, PDO::PARAM_STR);
            $sql->bindValue(":datet", $datet, PDO::PARAM_STR);
            $sql->bindValue(":lessonplan", $lessonplan, PDO::PARAM_STR);
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


    // get all lesson plans for users
    public function getUserLessonPlans()
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("No connection with database!");       
            }

            $sql = $db->prepare("SELECT * FROM $this->direction;");
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

    // get user lesson plan by group id and date data
    public function getUserLessonPlan($datefrom, $dateto, $groupid)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("No connection with database!");       
            }

            $sql = $db->prepare("SELECT * FROM $this->direction
                                WHERE date_from <= :datefrom 
                                AND date_to >= :dateto 
                                AND group_id = :groupid");

            $sql->bindValue(":datefrom", $datefrom, PDO::PARAM_STR);
            $sql->bindValue(":dateto", $dateto, PDO::PARAM_STR);    
            $sql->bindValue(":groupid", $groupid, PDO::PARAM_INT);      
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
            //return $er->getMessage();
            return false;
        }
    }
}

?>