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

    // include src/Controller/schoolYearController
    include_once(dirname(__FILE__)."/../../../src/Controller/schoolYearController.php");
    $schoolYearController = new schoolYearController();


    // take array from ajax action
    $schoolYear = $_POST['schoolYear'];
    $datef = $_POST['datef'];
    $datet = $_POST['datet'];
    $id = $_POST['id'];
    

    // update term
    if(!$schoolYearController->updateSchoolYear($id, $schoolYear, $datef, $datet))
    {
        // if something went wrong - show error message
        $session->setFlashMessage("Wystapil blad podczas aktualizacji!");
    }
    else
    {
        $session->setFlashMessage("Zaktualizowano pomyslnie!");
    }
}
?>