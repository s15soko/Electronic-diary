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


            $db = null;
            return true;
        } 
        catch(PDOException $er) 
        {
            $db->rollBack();
            return $er->getMessage();
            //return false;
        }  
    }

}

?>