<?php
// include src/Entity/databaseConnent
require_once(dirname(__FILE__). "/../Entity/databaseConnect.php");
// include src/Manager/sessionManager
require_once(dirname(__FILE__). "/../Manager/sessionManager.php");


class registerController
{
    // table in database
    private $direction = "user";


    // add new user to database
    public function registerUser($name, $surname, $schoolrole, $email, $pin, $address, $contact, $date, $login, $password, $role)
    {
        
        $flag = true;
        // check email, pin, login, password
        // rest in js

        // array for errors
        $errors = array();


        // check email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            // set flag as false
            $flag = false;
            // set error
            $errors[] = "Incorrect email";
        }
        // check pin
        if(strlen($pin) !== 11 || !is_numeric($pin))
        {
            // set flag as false
            $flag = false;
            // set error
            $errors[] = "Incorrect PIN";
        }
        // check login
        // login always unique
        // configured by database indexes
        if(strlen($login) > 65)
        {
            // set flag as false
            $flag = false;
            // set error
            $errors[] = "Login is too long";
        }
        if(strlen($login) < 3)
        {
            // set flag as false
            $flag = false;
            // set error
            $errors[] = "Login is too short";
        }
        // check password
        if(strlen($password) > 65)
        {
            // set flag as false
            $flag = false;
            // set error
            $errors[] = "Password is too long";
        }
        if(strlen($password) < 7)
        {
            // set flag as false
            $flag = false;
            // set error
            $errors[] = "Password is too short";
        }


        
        // set error flash messages
        if(!empty($errors))
        {
            $session = new sessionManager();
            $session->setFlashMessage($errors);
        }
        
        // if flag == true - register user
        if($flag)
        {
            try 
            {
                // get db
                $db = get_database(); 
                if(!$db)
                {
                    throw new PDOException("No connection with database!");       
                }


                // hash password
                $password = password_hash($password, PASSWORD_BCRYPT, array(15));
    
                // sql
                $sql = $db->prepare("INSERT INTO $this->direction VALUES 
                    (null, :username, :surname, :datebirth, :pin, :login, :password, :schoolrole, :role, :address, :contact, :email);");
                $sql->bindValue(":username", $name, PDO::PARAM_STR);
                $sql->bindValue(":surname", $surname, PDO::PARAM_STR);
                $sql->bindValue(":schoolrole", $schoolrole, PDO::PARAM_STR);
                $sql->bindValue(":email", $email, PDO::PARAM_STR);
                $sql->bindValue(":pin", $pin, PDO::PARAM_STR);
                $sql->bindValue(":address", $address, PDO::PARAM_STR);
                $sql->bindValue(":contact", $contact, PDO::PARAM_STR);
                $sql->bindValue(":datebirth", $date, PDO::PARAM_STR);
                $sql->bindValue(":login", $login, PDO::PARAM_STR);
                $sql->bindValue(":password", $password, PDO::PARAM_STR);
                $sql->bindValue(":role", $role, PDO::PARAM_STR);
    
                $sql->execute();
    
                // close connection
                $db = null;
    
                return true;
            } 
            catch(PDOException $er) 
            {
                // return $er->getMessage();
                return false;
            }
        }  
    }


    // return table name
    public function returnTableName()
    {
        return $this->direction;
    }
}

?>