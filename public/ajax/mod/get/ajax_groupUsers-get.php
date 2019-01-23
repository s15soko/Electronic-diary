<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    
    if($_SESSION['role'] === "USER")
    {
        exit();
    }

    // include src/Controller/groupsController
    require_once(dirname(__FILE__)."/../../../../src/Controller/groupsController.php");
    $groupsController = new groupsController();
    
    $id = $_POST['id'];

    // return data
    if($users = $groupsController->getGroupUsers($id))
    {
        echo json_encode($users);
    }
    else
    {
        return false;
    }
}
?>