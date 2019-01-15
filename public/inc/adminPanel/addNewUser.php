<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsAdmin())
{
    header("location: index.php");
    exit();
}

// include src/Controller/registerController
include_once(dirname(__FILE__)."/../../../src/Controller/registerController.php");
$registerController = new registerController();

// take table name
$tablename = $registerController->returnTableName();

// include src/Controller/formBuilderController
include_once(dirname(__FILE__)."/../../../src/Controller/formBuilderController.php");
// create form Builder Controller
$form_builder = new formBuilderController();


// include src/Controller/roleController
include_once(dirname(__FILE__)."/../../../src/Controller/roleController.php");
$roleController = new roleController();

$schoolroles = $roleController->returnSchoolRoles();
$roles = $roleController->returnRoles();

// set table name for form to add new user
$form_builder->setTableName($tablename);
// set
$form_builder->setFormMethod("POST");
$form_builder->setJsOnClick("addNewUser();");
$form_builder->setHeaderText(
    array(
        0 => "Name",
        1 => "Surname",
        2 => "School role",
        3 => "E-mail",
        4 => "PIN",
        5 => "Address",
        6 => "Contact",
        7 => "Date of birth",
        8 => "Login",
        9 => "Password",
        10 => "Role",
    )
);

$form_builder->setInputs(
    array(
        0 => array(
            "type" => "text",
            "name" => "name",
            "maxlength" => "64",
            "required" => "required",
        ),
        1 => array(
            "type" => "text",
            "name" => "surname",
            "maxlength" => "128",
            "required" => "required",
        ),
        2 => array(
            "type" => "selectrole", // select
            "options" => $schoolroles,
            "name" => "schoolrole",
            "required" => "required",
        ),
        3 => array(
            "type" => "text",
            "name" => "email",
        ),
        4 => array(
            "type" => "text",
            "name" => "pin",
            "maxlength" => "11",
            "required" => "required",
        ),
        5 => array(
            "type" => "text",
            "name" => "address",
            "maxlength" => "255",
        ),
        6 => array(
            "type" => "text",
            "name" => "contact",
            "maxlength" => "20",
        ),
        7 => array(
            "type" => "date",
            "name" => "birthdate",
        ),
        8 => array(
            "type" => "text",
            "name" => "login",
            "maxlength" => "64",
            "minlength" => "3",
            "required" => "required",
        ),
        9 => array(
            "type" => "text", // for admin left text
            "name" => "password",
            "maxlength" => "64",
            "minlength" => "8",
            "required" => "required",
        ),
        10 => array(
            "type" => "selectrole", // select
            "options" => $roles,
            "name" => "role",
            "required" => "required",
        ),
        11 => array(
            "type" => "submit",
            "name" => "submit",
            "value" => "Add user",
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
<script src="public/js/users.js"></script>


<!-- panel box -->
<div id="container">

    <h1 class='center_me' style='margin-bottom: 25px;'>Add new user</h1>
    
    <?php
        // include src/Builder/formBuilder
        include_once(dirname(__FILE__)."/../../../src/Builder/formBuilder.php");
    ?>

</div>


