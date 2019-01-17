<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");


class marksController
{
    // table name in database
    private $direction = "grade";
    private $direction2 = "grade_scale";
    private $direction3 = "grade_type";



    // find all user marks by term id
    public function getUserMarksByTermID($term_id, $user_id)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("No connection with database!");       
            }

            // return marks + data from $direction2 and $direction3
            $sql = $db->prepare("SELECT g.*, gs.*, gt.* 
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

    // find all user marks by year id
    public function getUserMarksByYearID($year_id, $user_id)
    {
        // pokaz wystawione oceny
    }


    // check for GET
    public function checkGET()
    {
        if(isset($_GET['y']) || isset($_GET['t']))
        {
            $results = [
                "year" => $_GET['y'],
                "term" => $_GET['t']
            ];
            // return results
            return $results;
        }
        return false;
    }

}
?>
