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

    // include src/Controller/userDataController
    include_once(dirname(__FILE__)."/../../../src/Controller/userDataController.php");
    $userDataController = new userDataController();


    // take array from ajax action
    $id = $_POST['id'];

    
    // add new class
    if(!$userDataController->setAsUser($id))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("Wystapil blad!");
    }
    else 
    {
        $session->setFlashMessage("Zaktualizowano pomyslnie!");
    }
}
?>