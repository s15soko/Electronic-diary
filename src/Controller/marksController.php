<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");


class marksController
{
    // table name in database
    private $direction = "oceny";
    private $direction2 = "ocena_skala";
    private $direction3 = "ocena_rodzaj";



    // find all user marks by term id
    public function getUserMarksByTermID($term_id, $user_id)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // return marks + data from $direction2 and $direction3
            $sql = $db->prepare("SELECT o.*, os.*, orr.* FROM $this->direction AS o 
                        INNER JOIN $this->direction2 AS os ON 
                        o.ocena = os.id AND 
                        o.id_ucznia = :iduser AND 
                        o.semestr = :idterm 
                        INNER JOIN $this->direction3 AS orr ON
                        o.rodzaj = orr.id
                        ORDER BY o.data DESC");

            $sql->bindValue(":iduser", $user_id, PDO::PARAM_INT);
            $sql->bindValue(":idterm", $term_id, PDO::PARAM_INT);
            $sql->execute();

            // fetch results
            $results = $sql->fetchAll();
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

            return $results;
        }
        return false;
    }


}


?>
