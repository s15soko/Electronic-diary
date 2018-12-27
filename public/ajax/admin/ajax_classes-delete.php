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
    $rows_id = $_POST['id'];

    // delete
    if(!$classController->deleteRows($rows_id))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("Wystapil blad!");
    }
}
?>