<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsAdmin())
        exit();

    // include src/Controller/subjectController
    include_once(dirname(__FILE__)."/../../../src/Controller/subjectController.php");
    $subjectController = new subjectController();

    // take array from ajax action
    $rows_id = $_POST['id'];

    // delete
    if(!$subjectController->deleteRows($rows_id))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("An occurred error!");
    }
    else $session->setFlashMessage("Deleted from database!");
}
?>