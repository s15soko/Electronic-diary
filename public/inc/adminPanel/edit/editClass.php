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

// include src/Controller/classController
require_once("src/Controller/classController.php");
// create object for class classController 
$classController = new classController();
$class_data = $classController->returnRow($id);

// take table name
$tablename = $classController->returnTableName();

// include src/Controller/formBuilderController
include_once(dirname(__FILE__)."/../../../../src/Controller/formBuilderController.php");
// create form Builder Controller
$form_builder = new formBuilderController();

// set form data...
$form_builder->setTableName($tablename);
$form_builder->setFormMethod("POST");
$form_builder->setJsOnClick("editClass();");
$form_builder->setHeaderText(
    array(
        0 => "Number:",
        1 => "Name:"
    )
);
$form_builder->setInputs(
    array(
        0 => array(
            "type" => "number",
            "name" => "number",
            "placeholder" => "Enter number",
            "value" => $class_data['number']
        ),
        1 => array(
            "type" => "text",
            "name" => "name",
            "placeholder" => "Enter name",
            "value" => $class_data['name']
        ),
        2 => array(
            "type" => "hidden",
            "name" => "id",
            "value" => $id
        ),
        3 => array(
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
<script src="public/js/classes.js"></script>


<!-- panel box -->
<div id="container">

    <?php
        // include src/Builder/formBuilder
        include_once(dirname(__FILE__)."/../../../../src/Builder/formBuilder.php");
    ?>

</div>

