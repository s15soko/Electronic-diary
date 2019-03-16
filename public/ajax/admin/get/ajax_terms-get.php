<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsAdmin())
        exit();
        
    // include src/Controller/termsController
    require_once(dirname(__FILE__)."/../../../../src/Controller/termsController.php");
    $termsController = new termsController();
    
    echo json_encode($termsController->getTerms());
}
?>