<?php
session_start();
// include src/Controller/roleController
include_once(dirname(__FILE__)."/../Controller/roleController.php");

class sessionManager
{
    // set session variables for user
    public function setSession($session)
    {
        $_SESSION['active_user'] = true;
        $_SESSION['user'] = $session['login'];
        $_SESSION['id_user'] = $session['id_uzytkownika'];

        $role = new roleController();
        // set user role in session 
        $_SESSION['role'] = $role->setUserRole($session['role']);  
        header("Location: ../../index.php");
    }

    // set error when login fail
    public function setLoginError($error)
    {
        $_SESSION['login_error'] = $error;
    }

    // destroy session
    public function destroySession()
    {
        session_destroy();
    }

    // check for active session
    public function checkIfIsActiveUserSession()
    {
        if(
            (isset($_SESSION['active_user']) && $_SESSION['active_user'] === true)
            && isset($_SESSION['user'])
            && isset($_SESSION['id_user'])
            && isset($_SESSION['role'])
        )
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    // check for admin roles
    public function checkIfIsAdmin()
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] === "ADMINISTRATOR")
        {
            return true;
        }
        else {
            return false;
        }
    }

    // set flash error message
    public function setFlashMessage($name)
    {
        $_SESSION['flashMessage'] = $name;
    }

    // return user id (id_user)
    public function returnUserId()
    {
        return $_SESSION['id_user'];
    }

}


?>