<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsActiveUserSession())
        exit();
    
    // include src/Controller/rankingController
    require_once(dirname(__FILE__)."/../../../../src/Controller/rankingController.php");
    $rankingController = new rankingController();

    $termid = $_POST['termid'];
    $schoolyearid = $_POST['schoolyearid'];
    
    echo json_encode($rankingController->getMarksForOneTermAndSchoolYear($termid, $schoolyearid));
}
?>