<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if($_SESSION['role'] === "USER")
        exit();

    // include src/Controller/lessonPlanController
    require_once(dirname(__FILE__)."/../../../../src/Controller/lessonPlanController.php");
    $lessonPlanController = new lessonPlanController();

    $datefrom = $_POST["datefrom"];
    $dateto = $_POST["dateto"]; 
    $teacherID = $_POST["teacherID"];

    echo json_encode($lessonPlanController->getTeacherLessonPlan($teacherID, $datefrom, $dateto));
}
?>