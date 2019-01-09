<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
    $session = new sessionManager();


    // 
    if(!$session->checkIfIsActiveUserSession())
    {
        exit();
    }


    // include src/Controller/messageController
    include_once(dirname(__FILE__)."/../../../src/Controller/messageController.php");
    $messageController = new messageController();


    // take array from ajax action
    $rows_id = $_POST['id'];

    
    // delete
    if(!$messageController->deleteInboxMessages($rows_id))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("Wystapil blad!");
    }
    else 
    {
        $session->setFlashMessage("Usunieto z bazy!");
    }
}
?>