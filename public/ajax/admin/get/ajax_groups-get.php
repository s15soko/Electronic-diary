<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    // if role !== ADMIN
    if(!$session->checkIfIsAdmin())
    {
        exit();
    }

    // include src/Controller/groupsController
    require_once(dirname(__FILE__)."/../../../../src/Controller/groupsController.php");
    $groupsController = new groupsController();
    
    // return data
    if($groups = $groupsController->getGroups())
    {
        echo json_encode($groups);
    }
    else
    {
        return false;
    }
}
?>