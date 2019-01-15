<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");



class messageController
{
    private $direction = "wiadomosc_nadawcza";
    private $direction2 = "wiadomosc_odbiorcza";


    // send a message
    public function sendAMessage($sender, $receiver, $title, $content)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // begin transaction
            $db->beginTransaction();

            // for sender
            $sql = $db->query("INSERT INTO $this->direction VALUES (null, $sender, $receiver, '$title', '$content', now());");
            // for receiver
            $sql2 = $db->query("INSERT INTO $this->direction2 VALUES (null, $receiver, $sender, '$title', '$content', now());");
            
            // commit
            $db->commit();

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


    // show user sent messages
    public function showUserSentMessages($userid)
    {
        try
        {
            // get db
            $db = get_database(); 
            // if db error
            if(!$db)
            {
                // return error
                throw new PDOException("Brak polaczenia z baza!");       
            }
            
            // sql
            // nadawca = user id 
            // inner join data about receiver user like name and surname
            $sql = $db->prepare("SELECT wn.*, u.imie, u.nazwisko FROM wiadomosc_nadawcza as wn 
                                INNER JOIN uzytkownik AS u ON wn.odbiorca = u.id AND wn.nadawca = :userid");

            // bind value
            $sql->bindValue(":userid", $userid, PDO::PARAM_INT);
            $sql->execute();

            // fetch results
            $results = $sql->fetchAll();

            // close connection
            $db = null;
            
            // return results
            return $results; 
        }   
        catch(PDOException $ex)
        {
            // set db error and show index.php
            return false;
        }
    }


    // show user inbox
    public function showUserInbox($userid)
    {
        try
        {
            // get db
            $db = get_database(); 
            // if db error
            if(!$db)
            {
                // return error
                throw new PDOException("Brak polaczenia z baza!");       
            }

            // sql
            // odbiorca = user id 
            // inner join data about sender user like name and surname
            $sql = $db->prepare("SELECT wo.*, u.imie, u.nazwisko FROM wiadomosc_odbiorcza as wo 
                        INNER JOIN uzytkownik AS u ON wo.nadawca = u.id AND wo.odbiorca = :userid");

            // bind value
            $sql->bindValue(":userid", $userid, PDO::PARAM_INT);
            $sql->execute();

            // fetch results
            $results = $sql->fetchAll();

            // close connection
            $db = null;
            
            //return results
            return $results;
            
        }   
        catch(PDOException $ex)
        {
            // set db error and show index.php
            return false;
        }
    }


    // delete sent messages 
    public function deleteSentMessages($rows_id)
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


    // delete inbox messages 
    public function deleteInboxMessages($rows_id)
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
                $sql = $db->prepare("DELETE FROM $this->direction2 WHERE id = :id");
         
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
}
?>