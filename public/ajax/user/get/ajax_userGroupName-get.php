<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsActiveUserSession())
        exit();

    // include src/Controller/groupsController
    require_once(dirname(__FILE__)."/../../../../src/Controller/groupsController.php");
    $groupsController = new groupsController();

    $userid = $_POST['userid'];

    // get all marks
    echo json_encode($groupsController->returnGroupName($userid));
}
?>