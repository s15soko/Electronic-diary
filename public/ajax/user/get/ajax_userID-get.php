<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsActiveUserSession())
        exit();

    // user id
    $userid = $session->returnUserId();

    echo json_encode($userid);
}
?>