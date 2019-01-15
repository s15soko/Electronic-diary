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

// include src/Controller/groupsController
require_once("src/Controller/groupsController.php");
// create object for class groupsController 
$groupsController = new groupsController();

$group_data = $groupsController->returnRow($id);
$tablename = $groupsController->returnTableName();


// include src/Controller/classController
require_once("src/Controller/classController.php");
$classController = new classController();
// get all school years for select options
$classes = $classController->getClasses();


// include src/Controller/learningDirectionController
require_once("src/Controller/learningDirectionController.php");
$learningDirectionController = new learningDirectionController();
// get all school years for select options
$directions = $learningDirectionController->getLearningDirections();




// include src/Controller/formBuilderController
include_once(dirname(__FILE__)."/../../../../src/Controller/formBuilderController.php");
// create form Builder Controller
$form_builder = new formBuilderController();


$form_builder->setTableName($tablename);
//set
$form_builder->setFormMethod("POST");
$form_builder->setJsOnClick("editGroup();");

$form_builder->setHeaderText(
    array(
        0 => "Name",
        1 => "Group",
        2 => "Class",
        3 => "Direction",
    )
);
$form_builder->setNameOptions(
    array(
        2 => "nazwa",
        3 => "nazwa_kierunku"
    )
);
$form_builder->setInputs(
    array(
        0 => array(
            "type" => "text",
            "name" => "name",
            "value" => $group_data['nazwa'],
            "required" => "required"   
        ),
        1 => array(
            "type" => "number",
            "name" => "number",
            "value" => $group_data['grupa'],
            "required" => "required"   
        ),
        2 => array(
            "type" => "select",
            "name" => "classid",
            "options" => $classes,
            "value" => $group_data['klasa_id']
        ),
        3 => array(
            "type" => "select",
            "name" => "directionid",
            "options" => $directions,
            "value" => $group_data['kierunek_id']
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
$name_options = $form_builder->getNameOptions();
$js = $form_builder->getJs();
?>






<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultForm.css"/>
<!-- scripts -->
<script src="public/js/groups.js"></script>





<!-- panel box -->
<div id="container">

    <?php
        // include src/Builder/formBuilder
        include_once(dirname(__FILE__)."/../../../../src/Builder/formBuilder.php");
    ?>

</div>

