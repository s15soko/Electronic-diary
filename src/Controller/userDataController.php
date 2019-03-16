<?php
require_once(dirname(__FILE__). "/../Entity/databaseConnect.php");
require_once(dirname(__FILE__). "/../Manager/sessionManager.php");

class userDataController extends DatabaseConnection
{
    /**
     * Get all users
     */
    public function getAllUsers()
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT * FROM user ORDER BY school_role;");
                $sql->execute();

                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Get all teachers
     */
    public function getAllTeachers()
    {
        if($this->db)
        {
            try {
                $sql = $this->db->prepare("SELECT t.id, t.name, t.surname, t.date_of_birth, t.PIN, t.login, t.school_role, t.role, t.address, t.contact, t.email FROM $this->direction AS t
                        WHERE t.school_role = 'TEACHER' 
                        OR t.school_role = 'DIRECTOR' ORDER BY t.school_role");
                $sql->execute();
                $results = $sql->fetchAll();

                return $results;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }

    /**
     * Set as user role
     */
    public function setAsUser($rows_id)
    {
        if($this->db)
        {
            try 
            {
                foreach ($rows_id as $key => $id) 
                {
                    $sql = $this->db->prepare("UPDATE user 
                            SET school_role = 'STUDENT', 
                            role = 'USER' 
                            WHERE id = :id");
                            
                    $sql->bindValue(":id", $id, PDO::PARAM_INT);
                    $sql->execute();
                }

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
    
    }


    /**
     * Get user data
     * 
     * @param string $param table row
     */
    public function getUserData($param = 0)
    {
        if($this->db)
        {
            $thing = "*";
            if($param !== 0)
            {
                // $thing = $param ex. "imie"
                $thing = $param;
            }
            try {
                $sql = $this->db->prepare("SELECT $thing FROM user WHERE id = :id;");
                $sql->bindValue(":id", (int)$_SESSION['id_user'], PDO::PARAM_INT);
                $sql->execute();
                $result = $sql->fetch();

                return $result;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }


    /**
     * Delete user row/rows
     * 
     * @param array<int> $users_id
     */
    public function deleteUsers($users_id)
    {
        if($this->db)
        {
            try {
                foreach ($users_id as $key => $value) 
                {
                    $sql = $db->prepare("DELETE FROM user WHERE id = :id");
            
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