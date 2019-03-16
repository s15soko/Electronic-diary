<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if($_SESSION['role'] === "USER")
        exit();

    echo json_encode($_SESSION['role']);
}
?>