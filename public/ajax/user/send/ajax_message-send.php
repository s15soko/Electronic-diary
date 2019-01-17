<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    // 
    if(!$session->checkIfIsActiveUserSession())
    {
        exit();
    }

    // include src/Controller/messageController
    require_once(dirname(__FILE__)."/../../../../src/Controller/messageController.php");
    $messageController = new messageController();

    // take array from ajax action
    // sender = student
    $sender = $_POST['stundentID'];
    // receiver = teacher
    $receiver = $_POST['teacherID'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    // send a message
    if(!$messageController->sendAMessage($sender, $receiver, $title, $content))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("An occurred error!");
    }
    else 
    {
        $session->setFlashMessage("Message sent!");
    }
    
    
}
?>