<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../src/Manager/sessionManager.php");
$session = new sessionManager();

// check GET for user with admin roles/privilege 
if($session->checkIfIsAdmin())
{
    //gets array
    $GETS = array(
        "terms" => "terms.php",
        "directions" => "learningDirections.php",
        "classes" => "classes.php",
        "users" => "",
        "subjects" => "",

        "direction" => "editLearningDirection.php",
        "term" => "editTerm.php"
        
    );

    // GET for admin panel
    if(isset($_GET["ap"]))
    {
        $link = $_GET['ap'];

        // foreach for ap get
        foreach($GETS as $key => $GET)
        {
            if($key === $link)
            {
                // include file 
                include("public/inc/adminPanel/".$GET);
                exit();
            }
            else {
                // 
            }
        }
    }
}

// check GET for user...
//gets array
$user_GETS = array(
    "marks" => "marks.php"
);
// GET for user panel
if(isset($_GET["up"]))
{
    $link = $_GET['up'];

    // foreach for ap get
    foreach($user_GETS as $key => $GET)
    {
        if($key === $link)
        {
            // include file 
            include("public/inc/userPanel/".$GET);
            exit();
        }
        else {
            // 
        }
    }
}




?>