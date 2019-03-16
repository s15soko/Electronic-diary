<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsAdmin())
        exit();

    // group id
    $id = $_POST['id'];

    // get all subjects
    // next return only this value where
    // subject is not assign to this one group

    // include src/Controller/groupsController
    require_once(dirname(__FILE__)."/../../../../src/Controller/groupsController.php");
    $groupsController = new groupsController();

    // get all school years for select options
    echo json_encode($groupsController->getSubjectsForGroup($id));
}
?>