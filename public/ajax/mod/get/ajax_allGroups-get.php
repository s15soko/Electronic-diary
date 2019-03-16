<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if($_SESSION['role'] === "USER")
        exit();

    // include src/Controller/groupsController
    require_once(dirname(__FILE__)."/../../../../src/Controller/groupsController.php");
    $groupsController = new groupsController();

    echo json_encode($groupsController->getGroups());
}
?>