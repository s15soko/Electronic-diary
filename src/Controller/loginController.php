<?php
// exit when server request is not POST
if(!$_SERVER['REQUEST_METHOD'] === 'POST')
{
    Header("Location: ../../index.php");
    exit();
}
// include src/Entity/databaseConnent
require_once("../Entity/databaseConnect.php");
// include src/Manager/sessionManager
require_once("../Manager/sessionManager.php");


class loginController
{
    // table in database
    private $user = "uzytkownik";

    // login 
    public function login($login, $password)
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
            // else...


            // sql
            $sql = $db->prepare("SELECT id, login, password, role FROM $this->user WHERE login = :login");

            // bind value
            $sql->bindValue(":login", $login, PDO::PARAM_STR);
            $sql->execute();

            // fetch result
            $result = $sql->fetch();
            $db = null;

            // if passwords are correct
            if(password_verify($password, $result['password']))
            {
                // set session for user
                $session = new sessionManager();
                $session->setSession($result);   
            }
            else // if not 
            {
                $result = null;
                // return error
                throw new PDOException("Bledne dane!");
            }
            
        }   
        catch(PDOException $ex)
        {
            // set db error and show index.php
            $session = new sessionManager();
            $session->setLoginError($ex->getMessage());   
            Header("Location: ../../index.php"); 
        }
    }
}

//
$user = new loginController();
$user->login($_POST['login'], $_POST['password']);

?>