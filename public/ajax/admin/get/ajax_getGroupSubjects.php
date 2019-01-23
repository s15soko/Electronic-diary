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


    // group id
    $id = $_POST['id'];


    // include src/Controller/groupsController
    require_once(dirname(__FILE__)."/../../../../src/Controller/groupsController.php");
    $groupsController = new groupsController();
    
    $subjects = $groupsController->getGroupSubjects($id);

    // return data
    if($subjects)
    {
        echo json_encode($subjects);
    }
    else
    {
        return false;
    }
}
?>