<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    // if role !== ADMIN
    if(!$session->checkIfIsAdmin())
    {
        exit();
    }

    // include src/Controller/termsController
    require_once(dirname(__FILE__)."/../../../../src/Controller/termsController.php");
    $termsController = new termsController();
    
    // return data
    if($terms = $termsController->getTerms())
    {
        echo json_encode($terms);
    }
    else
    {
        return false;
    }
}
?>