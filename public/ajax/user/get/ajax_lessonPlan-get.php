<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    //
    if(!$session->checkIfIsActiveUserSession())
    {
        exit();
    }

    // include src/Controller/lessonPlanController
    require_once(dirname(__FILE__)."/../../../../src/Controller/lessonPlanController.php");
    $lessonPlanController = new lessonPlanController();

    $datefrom = $_POST["datefrom"];
    $dateto = $_POST["dateto"]; 
    $groupid = $_POST["groupid"];

    $data = $lessonPlanController->getUserLessonPlan($datefrom, $dateto, $groupid);
    // return data
    if($data )
    {
        echo json_encode($data);
    }
    else
    {
        return false;
    }
}
?>