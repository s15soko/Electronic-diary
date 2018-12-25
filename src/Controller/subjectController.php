<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");



class subjectController
{
    // tables in databse
    private $direction = "przedmiot";
    private $direction2 = "przedmiotydlagrupy";
    private $direction3 = "uczenwgrupie";
    private $direction4 = "uzytkownik";


    // take user subjects
    public function getUserSubjects($user_id)
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
            $sql = $db->prepare("SELECT p.id, p.kolejnosc, p.krotka_nazwa, p.nazwa 
                FROM 
                $this->direction AS p, $this->direction2 AS pg, $this->direction3 AS ug, $this->direction4 AS u 
                WHERE 
                u.id = :id_user AND 
                ug.uczen_id = u.id AND 
                ug.grupa_id = pg.grupa_id AND 
                pg.przedmiot_id = p.id ORDER BY p.kolejnosc ASC");


            $sql->bindValue(":id_user", $user_id, PDO::PARAM_INT);
            $sql->execute();

            // fetch result
            $results = $sql->fetchAll();
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


}

?>