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


    // include src/Controller/rankingController
    require_once(dirname(__FILE__)."/../../../../src/Controller/rankingController.php");
    $rankingController = new rankingController();

    $termid = $_POST['termid'];
    $schoolyearid = $_POST['schoolyearid'];
    
    // get all marks
    $marks = $rankingController->getMarksForOneTermAndSchoolYear($termid, $schoolyearid);
    
    // return data
    if($marks)
    {
        echo json_encode($marks);
    }
    else
    {
        return false;
    }
}
?>