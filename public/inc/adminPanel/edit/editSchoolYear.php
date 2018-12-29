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
// create object for class schoolYearController 
$schoolYearController = new schoolYearController();
// return post/row from database
$schoolYear_data = $schoolYearController->getSchoolYearByID($id);


// take table name
$tablename = $schoolYearController->returnTableName();


// include src/Controller/formBuilderController
include_once(dirname(__FILE__)."/../../../../src/Controller/formBuilderController.php");
// create form Builder Controller
$form_builder = new formBuilderController();


// set table name for form to update
$form_builder->setTableName($tablename);
// set
$form_builder->setFormMethod("POST");
$form_builder->setJsOnClick("editSchoolYear();");
$form_builder->setHeaderText(
    array(
        0 => "Rok szkolny",
        1 => "Data od",
        2 => "Data do"
    )
);
$form_builder->setInputs(
    array(
        0 => array(
            "type" => "text",
            "name" => "schoolYear",
            "value" => $schoolYear_data['rok_szkolny']
        ),
        1 => array(
            "type" => "date",
            "name" => "datef",
            "value" => $schoolYear_data['data_od']
        ),
        2 => array(
            "type" => "date",
            "name" => "datet",
            "value" => $schoolYear_data['data_do']
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
<script src="public/js/schoolYears.js"></script>



<!-- panel box -->
<div id="container">

    <?php
        // include src/Builder/formBuilder
        include_once(dirname(__FILE__)."/../../../../src/Builder/formBuilder.php");
    ?>

</div>
