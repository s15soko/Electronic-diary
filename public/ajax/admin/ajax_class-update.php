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

    // include src/Controller/classController
    include_once(dirname(__FILE__)."/../../../src/Controller/classController.php");
    $classController = new classController();


    // take array from ajax action
    $number = $_POST['number'];
    $name = $_POST['name'];
    $id = $_POST['id'];
    
    // update term
    if(!$classController->updateClass($id, $number, $name))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("Wystapil blad podczas aktualizacji!");
    }
    else
    {
        $session->setFlashMessage("Zaktualizowano pomyslnie!");
    }
}
?>