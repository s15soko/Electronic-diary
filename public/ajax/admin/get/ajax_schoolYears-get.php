<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // include src/Manager/sessionManager
    include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
    $session = new sessionManager();

    if(!$session->checkIfIsAdmin())
        exit();

    // include src/Controller/schoolYearController
    require_once(dirname(__FILE__)."/../../../../src/Controller/schoolYearController.php");
    $schoolYearController = new schoolYearController();

    // get all school years for select options
    echo json_encode($schoolYearController->returnAllschoolYears());
}
?>