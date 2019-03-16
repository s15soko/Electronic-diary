<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsAdmin())
        exit();

    // include src/Controller/learningDirectionController
    include_once(dirname(__FILE__)."/../../../src/Controller/learningDirectionController.php");
    $learningDirectionController = new learningDirectionController();

    // take array from ajax action
    $name = $_POST['name'];
    $short = $_POST['short'];
    $id = $_POST['id'];

    // add new class
    if(!$learningDirectionController->updateDirection($id, $name, $short))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("An occurred error!");
    }
    else $session->setFlashMessage("Update successful!");
}
?>