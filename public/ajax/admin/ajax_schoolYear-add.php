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

    
    // include src/Controller/schoolYearController
    include_once(dirname(__FILE__)."/../../../src/Controller/schoolYearController.php");
    $schoolYearController = new schoolYearController();


    // take array from ajax action
    $schoolyear = $_POST['schoolyear'];
    $datef = $_POST['datef'];
    $datet = $_POST['datet'];


    // add new subject
    if(!$schoolYearController->addNewSchoolYear($schoolyear, $datef, $datet))
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