<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // take id from ajax action
    $id = $_POST['id'];

    // include src/Controller/subjectController
    include_once(dirname(__FILE__)."/../../../src/Controller/subjectController.php");
    $subjectController = new subjectController();
    $userSubjects = $subjectController->getUserSubjects($id);

    $JSON = json_encode($userSubjects);
    echo $JSON;
}

?>