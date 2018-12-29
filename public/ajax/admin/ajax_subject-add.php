<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    // if role !== ADMIN
    if(!$session->checkIfIsAdmin())
    {
        exit();
    }

    
    // include src/Controller/subjectController
    include_once(dirname(__FILE__)."/../../../src/Controller/subjectController.php");
    $subjectController = new subjectController();


    // take array from ajax action
    $order = $_POST['order'];
    $short = $_POST['short'];
    $name = $_POST['name'];


    // add new subject
    if(!$subjectController->addNewSubject($order, $short, $name))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("Wystapil blad!");
    }
    else 
    {
        $session->setFlashMessage("Dodano do bazy!");
    }
}
?>