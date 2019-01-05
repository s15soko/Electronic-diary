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
            $session->setFlashMessage("Dodano do bazy!");
        }
        else
        {
            $session->setFlashMessage("Wystapil blad!");
        }
        
    }
    else 
    {
        $session->setFlashMessage("Taka kombinacja juz istnieje!");
    }
}
?>