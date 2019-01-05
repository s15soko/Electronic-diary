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


    // include src/Controller/groupsController
    include_once(dirname(__FILE__)."/../../../src/Controller/groupsController.php");
    $groupsController = new groupsController();


    // take array from ajax action
    $rows_id = $_POST['id'];


    // delete 
    if(!$groupsController->deleteGroupSubjects($rows_id))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("Wystapil blad!");
    }
    else 
    {
        $session->setFlashMessage("Usunieto z bazy!");
    }
}
?>