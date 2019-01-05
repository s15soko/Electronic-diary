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



    // include src/Controller/classController
    require_once(dirname(__FILE__)."/../../../../src/Controller/classController.php");
    $classController = new classController();
    // get all school years for select options
    $classes = $classController->getClasses();

    
    // return data
    if($classes)
    {
        echo json_encode($classes);
    }
    else
    {
        return false;
    }
}
?>