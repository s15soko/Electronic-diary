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
    private $direction5 = "przedmiotydlanauczyciela";


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

            // fetch results
            $results = $sql->fetchAll();

            // close connection
            $db = null;

            //return results
            return $results;
            
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
            return false;
        }
    }

    // add new subject to database
    public function addNewSubject($order, $short, $name)
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
            $sql = $db->prepare("INSERT INTO $this->direction VALUES (null, :kolejnosc, :short, :sub_name);");
            
            $sql->bindValue(":kolejnosc", $order, PDO::PARAM_INT);
            $sql->bindValue(":short", $short, PDO::PARAM_STR);
            $sql->bindValue(":sub_name", $name, PDO::PARAM_STR);
            $sql->execute();

            // close connection
            $db = null;

            //return
            return true;
        } 
        catch(PDOException $er) 
        {
            // return $er->getMessage();
            return false;
        }
    }


    // get all subjects from database
    public function getSubjects()
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
            $sql = $db->prepare("SELECT * FROM $this->direction ORDER BY kolejnosc ASC;");
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


    // get subject by id
    public function getSubjectByID($subject_id)
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
            $sql = $db->prepare("SELECT * FROM $this->direction WHERE id = :id");
            $sql->bindValue(":id", $subject_id, PDO::PARAM_INT);
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
            // return $er->getMessage();
            return false;
        }
    }


    // update subject row
    public function updateSubject($id, $order, $short, $name)
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
            $sql = $db->prepare("UPDATE $this->direction SET kolejnosc = :order, krotka_nazwa = :short, nazwa = :subjectname WHERE id = :idsubject");
            $sql->bindValue(":idsubject", $id, PDO::PARAM_INT);
            $sql->bindValue(":order", $order, PDO::PARAM_INT);
            $sql->bindValue(":short", $short, PDO::PARAM_STR);
            $sql->bindValue(":subjectname", $name, PDO::PARAM_STR);
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

    // add new subject for teacher
    public function addNewTeacherSubject($teacherID, $subjectID)
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
            $sql = $db->prepare("INSERT INTO $this->direction5 VALUES (null, :subjectid, :teacherid);");

            $sql->bindValue(":teacherid", $teacherID, PDO::PARAM_INT);
            $sql->bindValue(":subjectid", $subjectID, PDO::PARAM_INT);
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

    // check if exist
    public function checkForTeacherSubject($teacherID, $subjectID)
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
            $sql = $db->prepare("SELECT * FROM $this->direction5 WHERE idprzedmiotu = :subjectid AND idnauczyciela = :teacherid;");
                                
            $sql->bindValue(":teacherid", $teacherID, PDO::PARAM_INT);
            $sql->bindValue(":subjectid", $subjectID, PDO::PARAM_INT);
            $sql->execute();

            // fetch results
            $results = $sql->fetchAll();

            // close connection
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

    // get all subjects for all teachers
    public function getTeachersSubjects()
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
            $sql = $db->prepare("SELECT pdn.id, 
                                pdn.idprzedmiotu, 
                                pdn.idnauczyciela, 
                                p.id AS pid, 
                                p.kolejnosc AS pkolejnoisc, 
                                p.krotka_nazwa AS pkrotka_nazwa, 
                                p.nazwa AS pnazwa 
                                FROM $this->direction5 as pdn 
                                INNER JOIN $this->direction as p ON pdn.idprzedmiotu = p.id");
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


    // delete subject row/rows
    public function deleteRows($rows_id)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // foreach sql
            foreach ($rows_id as $key => $value) 
            {
                $sql = $db->prepare("DELETE FROM $this->direction WHERE id = :id");
         
                $sql->bindValue(":id", $value, PDO::PARAM_INT);
                $sql->execute();
            }

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

    // delete teacher subjects
    public function deleteTeacherSubjects($rows_id)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // foreach sql
            foreach ($rows_id as $key => $value) 
            {
                $sql = $db->prepare("DELETE FROM $this->direction5 WHERE id = :id");
         
                $sql->bindValue(":id", $value, PDO::PARAM_INT);
                $sql->execute();
            }

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



    // return table name
    public function returnTableName()
    {
        return $this->direction;
    }

}

?>