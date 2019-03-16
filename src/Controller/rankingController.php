<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__). "/../Entity/databaseConnect.php");


class rankingController extends DatabaseConnection
{
    // table in database
    private $direction = 'grade';


    /**
     * get all marks
     * 
     * @param int $termid
     * @param int $schoolyearid
     */
    public function getMarksForOneTermAndSchoolYear($termid, $schoolyearid)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT g.id AS gradeid, 
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

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }
}
?>