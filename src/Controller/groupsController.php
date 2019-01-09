<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");



class groupsController
{
    // table name
    private $direction  = "grupa";
    private $direction2 = "klasa";
    private $direction3 = "kierunek";
    private $direction4 = "uczenwgrupie";
    private $direction5 = "przedmiotydlagrupy";


    // get all groups from database (+class data and direction data)
    public function getGroups()
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
            $sql = $db->prepare("SELECT g.*, k.id AS rok_szkolny_id, 
                                k.numer AS rok_szkolny_numer, 
                                k.nazwa AS rok_szkolny_nazwa, 
                                kk.nazwa_kierunku FROM $this->direction AS g 
                                INNER JOIN $this->direction2 AS k ON g.klasa_id = k.id 
                                INNER JOIN $this->direction3 as kk ON kk.id = g.kierunek_id
                                ORDER BY k.numer DESC, g.grupa ASC");
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


    // get group Users (by group id)
    public function getGroupUsers($id)
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
            $sql = $db->prepare("SELECT uwg.*, 
                                    u.id AS userid, 
                                    u.imie, 
                                    u.nazwisko, 
                                    u.rola_uzytkownika, 
                                    u.PIN FROM $this->direction4 AS uwg 
                                    INNER JOIN uzytkownik AS u ON uwg.uczen_id = u.id 
                                    AND uwg.grupa_id = :id");
                                

            $sql->bindValue(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            // fetch results
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


    // get group subjects (by group id)
    public function getGroupSubjects($id)
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
            $sql = $db->prepare("SELECT pdg.id, p.id AS pid, 
                                p.kolejnosc, p.krotka_nazwa, 
                                p.nazwa FROM przedmiotydlagrupy AS pdg 
                                INNER JOIN przedmiot AS p ON pdg.przedmiot_id = p.id
                                AND pdg.grupa_id = :id ORDER BY p.kolejnosc ASC");
                                

            $sql->bindValue(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            // fetch results
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


    // delete subjects from group
    public function deleteGroupSubjects($rows_id)
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


    // get all subjects + add data from other table
    // by left join
    public function getSubjectsForGroup($id)
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
            $sql = $db->prepare("SELECT p.*, pdg.grupa_id, pdg.przedmiot_id FROM przedmiot AS p 
                                LEFT JOIN $this->direction5 AS pdg ON pdg.przedmiot_id = p.id AND pdg.grupa_id = :id");
                                
            $sql->bindValue(":id", $id, PDO::PARAM_INT);
            $sql->execute();

            // fetch results
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


    // add subject to group
    public function addSubjectToGroup($groupId, $subjectId)
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

            $sql = $db->prepare("INSERT INTO $this->direction5 VALUES (null, :groupid, :subjectid);");
         
            $sql->bindValue(":groupid", $groupId, PDO::PARAM_INT);
            $sql->bindValue(":subjectid", $subjectId, PDO::PARAM_INT);
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
    public function checkForGroup($name, $number, $classID, $directionID)
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
            $sql = $db->prepare("SELECT * FROM $this->direction
                                WHERE nazwa = :g_name AND
                                grupa = :g_number AND
                                klasa_id = :classid AND
                                kierunek_id = :directionid;");
                                
            $sql->bindValue(":g_name", $name, PDO::PARAM_STR);
            $sql->bindValue(":g_number", $number, PDO::PARAM_INT);
            $sql->bindValue(":classid", $classID, PDO::PARAM_INT);
            $sql->bindValue(":directionid", $directionID, PDO::PARAM_INT);
            $sql->execute();

            // fetch results
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


    // update group
    public function updateGroup($id, $name, $number, $classid, $directionid)
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
            $sql = $db->prepare("UPDATE $this->direction SET 
                                nazwa = :namegroup, 
                                grupa = :groupnumber, 
                                klasa_id = :classid, 
                                kierunek_id = :directionid 
                                WHERE id = :idgroup");
                                
            $sql->bindValue(":idgroup", $id, PDO::PARAM_INT);
            $sql->bindValue(":namegroup", $name, PDO::PARAM_STR);
            $sql->bindValue(":groupnumber", $number, PDO::PARAM_INT);
            $sql->bindValue(":classid", $classid, PDO::PARAM_INT);
            $sql->bindValue(":directionid", $directionid, PDO::PARAM_INT);
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


    // add new group
    public function addNewGroup($name, $number, $classID, $directionID)
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
            $sql = $db->prepare("INSERT INTO $this->direction VALUES (null, :g_name, :g_number, :classid, :directionid);");
            $sql->bindValue(":g_name", $name, PDO::PARAM_STR);
            $sql->bindValue(":g_number", $number, PDO::PARAM_INT);
            $sql->bindValue(":classid", $classID, PDO::PARAM_INT);
            $sql->bindValue(":directionid", $directionID, PDO::PARAM_INT);
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

    // delete group row/rows
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


    // delete user from group
    public function deleteUserFromGroup($rows_id)
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
                $sql = $db->prepare("DELETE FROM $this->direction4 WHERE id = :id");
         
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



    // return values via id
    public function returnRow($id)
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
            $sql = $db->prepare("SELECT * FROM $this->direction WHERE id = :id;");
        
            $sql->bindValue(":id", $id, PDO::PARAM_INT);
            $sql->execute();
            // close connection
            $db = null;

            // fetch result
            $result = $sql->fetch();

            //return result
            return $result;
        } 
        catch(PDOException $er) 
        {
            //return $er->getMessage();
            return false;
        }
    }

    // return user group name
    public function returnGroupName($userid)
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
            $sql = $db->prepare("SELECT g.nazwa FROM $this->direction AS g
                            INNER JOIN $this->direction4 AS uwg ON 
                            g.id = uwg.grupa_id 
                            AND uwg.uczen_id = :userid");
        
            $sql->bindValue(":userid", $userid, PDO::PARAM_INT);
            $sql->execute();
            // close connection
            $db = null;

            // fetch result
            $result = $sql->fetch();

            //return result
            return $result;
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