<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    // if role !== ADMIN
    if(!$session->checkIfIsAdmin())
    {
        exit();
    }

    // include src/Controller/subjectController
    include_once(dirname(__FILE__)."/../../../src/Controller/subjectController.php");
    $subjectController = new subjectController();


    // take array from ajax action
    $teacherID = $_POST['teacherID'];
    $subjectID = $_POST['subjectID'];


    
    // check if not exist
    if(!$subjectController->checkForTeacherSubject($teacherID, $subjectID))
    {
        if($subjectController->addNewTeacherSubject($teacherID, $subjectID))
        {
            $session->setFlashMessage("Added to the database!");
        }
        else
        {
            $session->setFlashMessage("An occurred error!");
        }
        
    }
    else 
    {
        $session->setFlashMessage("This combination is already exist!");
    }
}
?>