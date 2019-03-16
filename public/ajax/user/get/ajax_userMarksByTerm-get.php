<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsActiveUserSession())
        exit();

    // include src/Controller/marksController
    require_once(dirname(__FILE__)."/../../../../src/Controller/marksController.php");
    $marksController = new marksController();

    $termID = $_POST['termID'];
    $userID = $_POST['userID'];
    
    echo json_encode($marksController->getUserMarksByTermID($termID, $userID));
}
?>