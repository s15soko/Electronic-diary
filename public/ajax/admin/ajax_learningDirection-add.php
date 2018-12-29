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


    // include src/Controller/learningDirectionController
    include_once(dirname(__FILE__)."/../../../src/Controller/learningDirectionController.php");
    $learningDirectionController = new learningDirectionController();

    
    // take array from ajax action
    $name = $_POST['name'];
    $short = $_POST['short'];


    // add new learning direction
    if(!$learningDirectionController->addNewDirection($name, $short))
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