<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsAdmin())
        exit();

    // include src/Controller/userDataController
    include_once(dirname(__FILE__)."/../../../src/Controller/userDataController.php");
    $userDataController = new userDataController();

    // take array from ajax action
    $users_id = $_POST['id'];

    // delete
    if(!$userDataController->deleteUsers($users_id))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("An occurred error!");
    }
    else $session->setFlashMessage("Deleted from database!");
}
?>