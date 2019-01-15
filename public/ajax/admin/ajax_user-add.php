<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
    $session = new sessionManager();


    // if role !== ADMIN
    if(!$session->checkIfIsAdmin())
    {
        exit();
    }


    // include src/Controller/registerController
    include_once(dirname(__FILE__)."/../../../src/Controller/registerController.php");
    $registerController = new registerController();

    
    // take array from ajax action
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $schoolrole = $_POST['schoolrole'];
    $email = $_POST['email'];
    $pin = $_POST['pin'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $date = $_POST['date'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    // add new learning direction
    if($registerController->registerUser($name, $surname, $schoolrole, $email, $pin, $address, $contact, $date, $login, $password, $role))
    {
        $session->setFlashMessage("Added to the database!");
    }
    else 
    {
        // error set by register controller
    }
}
?>