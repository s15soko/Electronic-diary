<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsActiveUserSession())
    {
        exit();
    }



    // include src/Controller/subjectController
    require_once(dirname(__FILE__)."/../../../../src/Controller/subjectController.php");
    $subjectController = new subjectController();
    // get all school years for select options
    $subjects = $subjectController->getSubjects();


    
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