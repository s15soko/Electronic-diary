<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");



class messageController
{
    private $direction = "outbox_message";
    private $direction2 = "receiving_message";


    // send a message
    public function sendAMessage($sender, $receiver, $title, $content)
    {
        try 
        {
            // get db
            $db = get_database(); 
            if(!$db)
            {
                throw new PDOException("No connection with database!");       
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
                throw new PDOException("No connection with database!");       
            }
            
            // sql
            // inner join data about receiver user like name and surname
            $sql = $db->prepare("SELECT 
                        om.*, u.name, u.surname
                        FROM `outbox_message` AS om
                        INNER JOIN `user` AS u
                        ON om.sender_id = u.id
                        AND om.sender_id = :userid");

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
                throw new PDOException("No connection with database!");       
            }

            // sql
            // inner join data about sender user like name and surname
            $sql = $db->prepare("SELECT 
                        rm.*, u.name, u.surname
                        FROM `receiving_message` AS rm
                        INNER JOIN `user` AS u
                        ON rm.receiver_id = u.id
                        AND rm.receiver_id = :userid");

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
                throw new PDOException("No connection with database!");       
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
                throw new PDOException("No connection with database!");       
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