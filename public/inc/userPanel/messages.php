<?php
// include src/Manager/sessionManager
require_once("src/Manager/sessionManager.php");
$session = new sessionManager();

if(!$session->checkIfIsActiveUserSession())
{
    header("Location: index.php");
    exit();
}


// get user id
$userid = $session->returnUserId();


// include src/Controller/messageController
require_once("src/Controller/messageController.php");
$messageController = new messageController();

?>


