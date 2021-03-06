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


// include src/Controller/schoolYearController
require_once("src/Controller/schoolYearController.php");
$schoolYearController = new schoolYearController();
// get all school years for select options
$schoolYears = $schoolYearController->returnAllschoolYears();


// include src/Controller/termsController
require_once("src/Controller/termsController.php");
// create object for class termsController 
$termsController = new termsController();
// return post/row from database
$term_data = $termsController->returnRow($id);

// take table name
$tablename = $termsController->returnTableName();




// include src/Controller/formBuilderController
include_once(dirname(__FILE__)."/../../../../src/Controller/formBuilderController.php");
// create form Builder Controller
$form_builder = new formBuilderController();


// set table name for form to update...
$form_builder->setTableName($tablename);
// set
$form_builder->setFormMethod("POST");
$form_builder->setJsOnClick("editTerm();");
$form_builder->setHeaderText(
    array(
        0 => "School year:",
        1 => "Term:",
        2 => "Date from:",
        3 => "Date to:"
    )
);
$form_builder->setNameOptions(array(0 => "school_year"));
$form_builder->setInputs(
    array(
        0 => array(
            "type" => "select",
            "name" => "rok_szkolny",
            "options" => $schoolYears,
            "value" => $term_data['school_year_id'],
            "required" => "required"   
        ),
        1 => array(
            "type" => "text",
            "placeholder" => "Term",
            "name" => "semestr",
            "value" => $term_data['name'],
            "required" => "required"
        ),
        2 => array(
            "type" => "date",
            "placeholder" => "Date from",
            "name" => "data_f",
            "value" => $term_data['date_from']  
        ),
        3 => array(
            "type" => "date",
            "placeholder" => "Date to",
            "name" => "data_t",
            "value" => $term_data['date_to']  
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
<script src="public/js/terms.js"></script>



<!-- panel box -->
<div id="container">

    <?php
        // include src/Builder/formBuilder
        include_once(dirname(__FILE__)."/../../../../src/Builder/formBuilder.php");
    ?>

</div>

