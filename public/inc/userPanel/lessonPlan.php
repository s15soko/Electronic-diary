<?php
// lesson plan for student

// include src/Manager/sessionManager
require_once("src/Manager/sessionManager.php");
$session = new sessionManager();

if(!$session->checkIfIsActiveUserSession())
{
    header("Location: index.php");
    exit();
}
?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/lessonplan.css"/> 
<!-- scripts -->
<script src="public/js/user_lessonplan.js"></script>


<!-- panel box -->
<div id="container">

    <div id="lessonplan_nav">

        Term:
        <select id="">

        </select>
        &nbsp;&nbsp;&nbsp;
        Group:
        <select id="">

        </select>


    </div>
    <div id="lessonplan_container">

        <div id="hours_container">
            <div class='nav_info'></div>
        </div>

        <div id="lessons_container">
            <div class='lesson_container'><div class='nav_info'></div></div>
            <div class='lesson_container'><div class='nav_info'></div></div>
            <div class='lesson_container'><div class='nav_info'></div></div>
            <div class='lesson_container'><div class='nav_info'></div></div>
            <div class='lesson_container'><div class='nav_info'></div></div>
        </div>

    </div>

</div>

