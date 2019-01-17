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

    // include src/Controller/subjectController
    require_once(dirname(__FILE__)."/../../../../src/Controller/subjectController.php");
    $subjectController = new subjectController();

    $user_id = $_POST['userID'];

    // user subjects
    $userSubjects = $subjectController->getUserSubjects($user_id);
        
    // return data
    if($userSubjects)
    {
        echo json_encode($userSubjects);
    }
    else
    {
        return false;
    }
}
?>