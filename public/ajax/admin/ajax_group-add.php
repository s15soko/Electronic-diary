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
        {
            $session->setFlashMessage("Dodano do bazy!");
        }
        else
        {
            $session->setFlashMessage("Wystapil blad!");
        }
        
    }
    else 
    {
        $session->setFlashMessage("Taka grupa juz istnieje!");
    }
}
?>