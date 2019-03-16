<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
    $session = new sessionManager();
    
    if(!$session->checkIfIsAdmin())
        exit();

    // include src/Controller/termsController
    include_once(dirname(__FILE__)."/../../../src/Controller/termsController.php");
    $termsController = new termsController();

    // take array from ajax action
    $year = $_POST['year'];
    $term = $_POST['term'];
    $df = $_POST['df'];
    $dt = $_POST['dt'];
    $id = $_POST['id'];
    
    // update term
    if(!$termsController->updateTerm($id, $year, $term, $df, $dt))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("An occurred error during update!");
    }
    else $session->setFlashMessage("Update successful!");
}
?>