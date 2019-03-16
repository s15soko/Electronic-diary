<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsAdmin())
        exit();

    // include src/Controller/groupsController
    include_once(dirname(__FILE__)."/../../../src/Controller/groupsController.php");
    $groupsController = new groupsController();

    $groupID = $_POST['groupid'];
    $userID = $_POST['userid'];

    // add new learning direction
    if($groupsController->addUserToGroup($groupID, $userID))
    {
        $session->setFlashMessage("Added to the database!");
    }
    else $session->setFlashMessage("An occurred error!");
}
?>