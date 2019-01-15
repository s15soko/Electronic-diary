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


// include src/Controller/learningDirectionController
require_once("src/Controller/learningDirectionController.php");
// create object for class learningDirectionController 
$learningDirectionController = new learningDirectionController();
// return post/row from database
$direction_data = $learningDirectionController->returnRow($id);


// take table name
$tablename = $learningDirectionController->returnTableName();



// include src/Controller/formBuilderController
include_once(dirname(__FILE__)."/../../../../src/Controller/formBuilderController.php");
// create form Builder Controller
$form_builder = new formBuilderController();


// set table name for form to update...
$form_builder->setTableName($tablename);
// set 
$form_builder->setFormMethod("POST");
$form_builder->setJsOnClick("editLearningDirection();");
$form_builder->setHeaderText(
    array(
        0 => "Name:",
        1 => "Short name:"
    )
);
$form_builder->setInputs(
    array(
        0 => array(
            "type" => "text",
            "placeholder" => "Direction name",
            "name" => "name",
            "value" => $direction_data['nazwa_kierunku']
        ),
        1 => array(
            "type" => "text",
            "placeholder" => "Direction short name",
            "name" => "short",
            "value" => $direction_data['krotka_nazwa']  
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
<script src="public/js/LearningDirections.js"></script>



<!-- panel box -->
<div id="container">

    <?php
        // include src/Builder/formBuilder
        include_once(dirname(__FILE__)."/../../../../src/Builder/formBuilder.php");
    ?>
    
</div>