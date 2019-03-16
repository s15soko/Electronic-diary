<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsActiveUserSession())
        exit();
    
    // include src/Controller/subjectController
    require_once(dirname(__FILE__)."/../../../../src/Controller/subjectController.php");
    $subjectController = new subjectController();

    $user_id = $_POST['userID'];
        
    echo json_encode($subjectController->getUserSubjects($user_id));
}
?>