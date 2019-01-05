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



    // include src/Controller/subjectController
    require_once(dirname(__FILE__)."/../../../../src/Controller/subjectController.php");
    $subjectController = new subjectController();
    // get all school years for select options
    $teachersSubjects = $subjectController->getTeachersSubjects();

    


    // return data
    if($teachersSubjects)
    {
        echo json_encode($teachersSubjects);
    }
    else
    {
        return false;
    }
}
?>