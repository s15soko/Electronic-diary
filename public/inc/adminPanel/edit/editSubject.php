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
        0 => "Order",
        1 => "Short name",
        2 => "Name"
    )
);
$form_builder->setInputs(
    array(
        0 => array(
            "type" => "number",
            "name" => "order",
            "value" => $subject_data['order']
        ),
        1 => array(
            "type" => "text",
            "name" => "short",
            "placeholder" => "Enter short name",
            "value" => $subject_data['short_name']
        ),
        2 => array(
            "type" => "text",
            "name" => "name",
            "placeholder" => "Enter name",
            "value" => $subject_data['name']
        ),
        4 => array(
            "type" => "hidden",
            "name" => "id",
            "value" => $id
        ),
        5 => array(
            "type" => "submit",
            "name" => "submit",
            "value" => "Update"
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

