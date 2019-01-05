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



    // include src/Controller/userDataController
    require_once(dirname(__FILE__)."/../../../../src/Controller/userDataController.php");
    $userDataController = new userDataController();
    // get all school years for select options
    $teachers = $userDataController->getAllTeachers();


    
    // return data
    if($teachers)
    {
        echo json_encode($teachers);
    }
    else
    {
        return false;
    }
}
?>