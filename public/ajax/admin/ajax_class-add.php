<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    // if role !== ADMIN
    if(!$session->checkIfIsAdmin())
        exit();

    // include src/Controller/classController
    include_once(dirname(__FILE__)."/../../../src/Controller/classController.php");
    $classController = new classController();

    // take array from ajax action
    $number = $_POST['number'];
    $name = $_POST['name'];

    // add new class
    if(!$classController->addNewClass($number, $name))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("An occurred error!");
    }
    else $session->setFlashMessage("Added to the database!");
    
}
?>