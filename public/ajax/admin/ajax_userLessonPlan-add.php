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


    // include src/Controller/lessonPlanController
    include_once(dirname(__FILE__)."/../../../src/Controller/lessonPlanController.php");
    $lessonPlanController = new lessonPlanController();

    $term = $_POST['term'];
    $class = $_POST['userclass'];
    $group = $_POST['group'];
    $desc = $_POST['desc'];
    $datef = $_POST['datef'];
    $datet = $_POST['datet'];
    $lessonplan = $_POST['lessonplan'];


    // add new lesson plan
    if($lessonPlanController->addUserLessonPlan($term, $class, $group, $desc, $datef, $datet, $lessonplan))
    {
        $session->setFlashMessage("Added to the database!");
    }
    else 
    {
        // error set by register controller
    }
}
?>