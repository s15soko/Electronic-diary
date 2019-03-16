<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__)."/../Entity/databaseConnect.php");



class messageController extends DatabaseConnection
{
    private $direction = "outbox_message";
    private $direction2 = "receiving_message";


    /**
     * Send a message
     * 
     * @param int $sender
     * @param int $receiver
     * @param string $title
     * @param string $content
     */
    public function sendAMessage($sender, $receiver, $title, $content)
    {
        if($this->db)
        {
            $sender = (int) $sender;
            $receiver = (int) ($receiver);
            $title = htmlentities($title);
            $content = htmlentities($content);

            try {
                $this->db->beginTransaction();

                $sql1 = "INSERT INTO $this->direction VALUES (null, $sender, $receiver, '$title', '$content', now());";
                $this->db->exec($sql1);

                $sql2 = "INSERT INTO $this->direction2 VALUES (null, $receiver, $sender, '$title', '$content', now());";
                $this->db->exec($sql2);

                $this->db->commit();
                return true;
            } catch (\Throwable $th) {
                $this->db->rollBack();
                return false;
            }
        }

    }


    /**
     * Show user sent messages
     * 
     * @param int $userid
     */
    public function showUserSentMessages($userid)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT 
                        om.*, u.name, u.surname
                        FROM `outbox_message` AS om
                        INNER JOIN `user` AS u
                        ON om.receiver_id = u.id
                        AND om.sender_id = :userid");

                // bind value
                $sql->bindValue(":userid", $userid, PDO::PARAM_INT);
                $sql->execute();

                $results = $sql->fetchAll();

                return $results; 
            } catch (\Throwable $th) {
                return false;
            }
        }
    }


    /**
     * Show user inbox
     * 
     * @param int $userid
     */ 
    public function showUserInbox($userid)
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT 
                        rm.*, u.name, u.surname
                        FROM `receiving_message` AS rm
                        INNER JOIN `user` AS u
                        ON rm.sender_id = u.id
                        AND rm.receiver_id = :userid");

                // bind value
                $sql->bindValue(":userid", $userid, PDO::PARAM_INT);
                $sql->execute();

                $results = $sql->fetchAll();

            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Delete sent messages
     * 
     * @param array<int> $rows_id 
     */
    public function deleteSentMessages($rows_id)
    {
        if($this->db)
        {
            try {
                foreach ($rows_id as $key => $value) 
                {
                    $sql = $this->db->prepare("DELETE FROM $this->direction WHERE id = :id");
            
                    $sql->bindValue(":id", $value, PDO::PARAM_INT);
                    $sql->execute();
                }

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }


    /**
     * delete inbox messages 
     */ 
    public function deleteInboxMessages($rows_id)
    {
        if($this->db)
        {
            try {
                foreach ($rows_id as $key => $value) 
                {
                    $sql = $this->db->prepare("DELETE FROM $this->direction2 WHERE id = :id");
            
                    $sql->bindValue(":id", $value, PDO::PARAM_INT);
                    $sql->execute();
                }

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }
}
?>