<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if($_SESSION['role'] === "USER")
    {
        exit();
    }

    // include src/Controller/marksController
    include_once(dirname(__FILE__)."/../../../src/Controller/marksController.php");
    $marksController = new marksController();


    // take array from ajax
    $users = $_POST['users'];
    
    $teacherID = $_POST['teacherID'];
    $schoolYearID = $_POST['schoolYearID'];
    $termID = $_POST['termID'];
    $subjectID = $_POST['subjectID'];
    $gradeWeight = $_POST['gradeWeight'];
    $gradeRange = $_POST['gradeRange'];
    $gradeTypeID = $_POST['gradeTypeID'];
    $gradeID = $_POST['gradeID'];
    
    // add new class
    if(!$marksController->addNewGrade($users, $teacherID, $schoolYearID, $termID, $subjectID, $gradeWeight, $gradeRange, $gradeTypeID, $gradeID))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("An occurred error!");
    }
    else 
    {
        $session->setFlashMessage("Added to the database!");
    }
}
?>