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


class loginController extends DatabaseConnection
{
    // table in database
    private $user = "user";

    /**
     * Log in 
     * 
     * @param string $login
     * @param string $password
     */
    public function login($login, $password)
    {
        if($this->db)
        {
            try {
                // find user
                $sql = $this->db->prepare("SELECT id, login, password, school_role, role FROM $this->user WHERE login = :login");

                // bind value
                $sql->bindValue(":login", $login, PDO::PARAM_STR);
                $sql->execute();

                // fetch result
                $result = $sql->fetch();

                // if passwords are correct
                // set user session  
                if(password_verify($password, $result['password']))
                {
                    // set session for user
                    $session = new sessionManager();
                    $session->setSession($result);   
                }
                else // if not = login error
                {
                    $result = null;

                    // return error
                    throw new PDOException("Incorrect data!");
                }
            } catch (\Throwable $th) {
                $session = new sessionManager();
                $session->setLoginError($th->getMessage());   
                Header("Location: ../../index.php"); 
            }
        }
    }
}

// values for form 
$user = new loginController();
$user->login($_POST['login'], $_POST['password']);

?>