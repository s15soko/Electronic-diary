<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsActiveUserSession())
        exit();
    

    // include src/Controller/lessonPlanController
    require_once(dirname(__FILE__)."/../../../../src/Controller/lessonPlanController.php");
    $lessonPlanController = new lessonPlanController();

    echo json_encode($lessonPlanController->getLessonHours());
}
?>