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


    // include src/Controller/marksController
    require_once(dirname(__FILE__)."/../../../../src/Controller/marksController.php");
    $marksController = new marksController();
    
    $term = $_POST['term'];
    $subject = $_POST['subject'];


    // return data
    if($marks = $marksController->getUsersMarksByTermIDSubjectID($term, $subject))
    {
        echo json_encode($marks);
    }
    else
    {
        return false;
    }
}
?>