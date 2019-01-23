<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    
    if($_SESSION['role'] === "USER")
    {
        exit();
    }

    // include src/Controller/subjectController
    require_once(dirname(__FILE__)."/../../../../src/Controller/subjectController.php");
    $subjectController = new subjectController();
    
    $id = $_POST['id'];

    // return data
    if($subjects = $subjectController->getTeacherSubjects($id))
    {
        echo json_encode($subjects);
    }
    else
    {
        return false;
    }
}
?>