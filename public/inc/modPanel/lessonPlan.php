<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
$session = new sessionManager();

if($_SESSION['role'] === "USER")
{
    header("location: index.php");
    exit();
}


?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/lessonplan.css"/> 
<!-- scripts -->
<script src="public/js/teacher_lessonplan.js"></script>


<!-- panel box -->
<div id="container">


    <div id="lessonplan_container">

        <div id="hours_container">
            <div class='nav_info'></div>
        </div>

        <div id="lessons_container">

        </div>

    </div>
</div>

