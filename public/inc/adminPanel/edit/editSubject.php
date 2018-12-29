<?php
// check if is set $_GET[id]
if(isset($_GET['id']))
{
    // save to id
    $id = $_GET['id'];
    
}
else 
{
    // 
    header("");
    exit();
}


// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsAdmin())
{
    header("location: index.php");
    exit();
}


// include src/Controller/subjectController
require_once("src/Controller/subjectController.php");
// create object for class subjectController 
$subjectController = new subjectController();
// return post/row from database
$subject_data = $subjectController->getSubjectByID($id);


// take table name
$tablename = $subjectController->returnTableName();


// include src/Controller/formBuilderController
include_once(dirname(__FILE__)."/../../../../src/Controller/formBuilderController.php");
// create form Builder Controller
$form_builder = new formBuilderController();


// set table name for form to update
$form_builder->setTableName($tablename);
// set
$form_builder->setFormMethod("POST");
$form_builder->setJsOnClick("editSubject();");
$form_builder->setHeaderText(
    array(
        0 => "Kolejność",
        1 => "Krótka nazwa",
        2 => "Nazwa"
    )
);
$form_builder->setInputs(
    array(
        0 => array(
            "type" => "number",
            "name" => "order",
            "value" => $subject_data['kolejnosc']
        ),
        1 => array(
            "type" => "text",
            "name" => "short",
            "placeholder" => "Wprowadz krotka nazwe",
            "value" => $subject_data['krotka_nazwa']
        ),
        2 => array(
            "type" => "text",
            "name" => "name",
            "placeholder" => "Wprowadz nazwe",
            "value" => $subject_data['nazwa']
        ),
        4 => array(
            "type" => "hidden",
            "name" => "id",
            "value" => $id
        ),
        5 => array(
            "type" => "submit",
            "name" => "submit",
            "value" => "Aktualizuj"
        )
    )
);

// get
$method = $form_builder->getMethod();
$headertext = $form_builder->getHeaderText();
$inputs = $form_builder->getInputs();
$js = $form_builder->getJs();

?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultForm.css"/>
<!-- scripts -->
<script src="public/js/subjects.js"></script>



<!-- panel box -->
<div id="container">

    <?php
        // include src/Builder/formBuilder
        include_once(dirname(__FILE__)."/../../../../src/Builder/formBuilder.php");
    ?>

</div>

