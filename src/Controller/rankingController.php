<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__). "/../Entity/databaseConnect.php");


class rankingController
{
    // table in database
    private $direction = 'oceny';


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
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // sql
            $sql = $db->prepare("SELECT o.id AS ocenaid, o.id_ucznia AS iducznia ,os.ocena, os.wartosc, o.waga_oceny, o.semestr, p.nazwa, uwg.grupa_id AS grupaucznia, g.nazwa AS nazwagrupy 

                                    FROM oceny AS o

                                    INNER JOIN ocena_skala AS os ON os.id = o.ocena
                                    INNER JOIN semestr AS s ON s.id = o.semestr
                                    INNER JOIN przedmiot AS p ON o.przedmiot = p.id
                                    INNER JOIN uczenwgrupie AS uwg ON o.id_ucznia = uwg.uczen_id
                                    INNER JOIN grupa AS g ON g.id = uwg.grupa_id

                                    AND o.semestr = :termid
                                    AND o.rok_szkolny = :schoolyearid");
                                
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