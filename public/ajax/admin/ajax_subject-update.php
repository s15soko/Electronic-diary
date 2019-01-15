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

    // include src/Controller/subjectController
    include_once(dirname(__FILE__)."/../../../src/Controller/subjectController.php");
    $subjectController = new subjectController();


    // take array from ajax action
    $order = $_POST['order'];
    $short = $_POST['short'];
    $name = $_POST['name'];
    $id = $_POST['id'];
    
    // update term
    if(!$subjectController->updateSubject($id, $order, $short, $name))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("An occurred error during update!");
    }
    else
    {
        $session->setFlashMessage("Update successful!");
    }
}
?>