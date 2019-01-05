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
    $name = $_POST['name'];
    $number = $_POST['number'];
    $classid = $_POST['classid'];
    $directionid = $_POST['directionid'];
    $id = $_POST['id'];
    
    // update term
    if(!$groupsController->updateGroup($id, $name, $number, $classid, $directionid))
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