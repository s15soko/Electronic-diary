<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    //
    if(!$session->checkIfIsActiveUserSession())
    {
        exit();
    }

    // include src/Controller/groupsController
    require_once(dirname(__FILE__)."/../../../../src/Controller/groupsController.php");
    $groupsController = new groupsController();

    $userid = $_POST['userid'];

    // get all marks
    $groupName = $groupsController->returnGroupName($userid);

    // return data
    if($groupName)
    {
        echo json_encode($groupName);
    }
    else
    {
        return false;
    }
}
?>