<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsAdmin())
        exit();

    // include src/Controller/groupsController
    include_once(dirname(__FILE__)."/../../../src/Controller/groupsController.php");
    $groupsController = new groupsController();

    // take array from ajax action
    $name = $_POST['name'];
    $number = $_POST['number'];
    $classID = $_POST['classID'];
    $directionID = $_POST['directionID'];
    
    // check if not exist
    if(!$groupsController->checkForGroup($name, $number, $classID, $directionID))
    {
        if($groupsController->addNewGroup($name, $number, $classID, $directionID))
            $session->setFlashMessage("Added to the database!");
        else $session->setFlashMessage("An occurred error!");        
    }
    else $session->setFlashMessage("This group is already exist!");
    
}
?>