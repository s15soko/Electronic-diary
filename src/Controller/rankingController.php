<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__). "/../Entity/databaseConnect.php");


class rankingController
{
    // table in database
    private $direction = 'grade';


    // get all marks from database
    // by term id and by school year id
    public function getMarksForOneTermAndSchoolYear($termid, $schoolyearid)
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
            $sql = $db->prepare("SELECT g.id AS gradeid, 
                                    g.student_id,
                                    gs.grade, 
                                    gs.value, 
                                    g.weight, 
                                    g.term_id, 
                                    s.name,
                                    ug.group_id AS usergroup, 
                                    gg.name AS groupname 

                                    FROM `grade` AS g

                                    INNER JOIN `grade_scale` AS gs ON gs.id = g.grade
                                    INNER JOIN `term` AS t ON t.id = g.term_id
                                    INNER JOIN `subject` AS s ON g.subject_id = s.id
                                    INNER JOIN `user_group` AS ug ON g.student_id = ug.student_id
                                    INNER JOIN `group` AS gg ON gg.id = ug.group_id

                                    AND g.term_id = :termid
                                    AND g.school_year_id = :schoolyearid");
                                
            $sql->bindValue(":termid", $termid, PDO::PARAM_INT);
            $sql->bindValue(":schoolyearid", $schoolyearid, PDO::PARAM_INT);
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
}
?>