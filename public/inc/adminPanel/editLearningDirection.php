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
include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsAdmin())
{
    header("location: index.php");
    exit();
}


// include src/Controller/learningDirectionController
require_once("src/Controller/learningDirectionController.php");
// create object for class learningDirectionController 
$obj = new learningDirectionController();
// return post/row from database
$direction_data = $obj->returnRow($id);
// take table name
$tablename = $obj->returnTableName();



// include src/Controller/formBuilderController
include_once(dirname(__FILE__)."/../../../src/Controller/formBuilderController.php");
// create form Builder Controller
$form_builder = new formBuilderController();
// set table name for form to update...
$form_builder->setTableName($tablename);
// set method for form
$form_builder->setFormMethod("POST");
$form_builder->setHeaderText(
    array(
        0 => "Nazwa:",
        1 => "Krótka nazwa:"
    )
);
$form_builder->setInputs(
    array(
        0 => array(
            "type" => "text",
            "placeholder" => "Nazwa kierunku",
            "name" => "name",
            "value" => $direction_data['nazwa_kierunku']
        ),
        1 => array(
            "type" => "text",
            "placeholder" => "Krótka nazwa kierunku",
            "name" => "short",
            "value" => $direction_data['krotka_nazwa']  
        ),
        2 => array(
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

?>



<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultForm.css"/>
<link rel="stylesheet" type="text/css" href="public/css/learningDirections.css"/>



<!-- panel box -->
<div id="container">

    <?php
        // include src/Builder/formBuilder
        include_once(dirname(__FILE__)."/../../../src/Builder/formBuilder.php");
    ?>






</div>