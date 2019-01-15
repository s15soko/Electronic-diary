<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsAdmin())
{
    header("location: index.php");
    exit();
}


?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/marks.css"/>
<link rel="stylesheet" type="text/css" href="public/css/umarks.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>

<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>



<!-- panel box -->
<div id="container">

    <h1 style='margin-bottom: 25px;'>Tachers card</h1>

    Select term:
    <select value='termID'>
        <option>Current term</option>
    </select>

    <br/><br/>
    Select group:
    <select value='groupID'>
        <option></option>
    </select>

    <br/><br/>
    Select subject:
    <select value='subjecID'>
        <option></option>
    </select>




    




  
</div>
