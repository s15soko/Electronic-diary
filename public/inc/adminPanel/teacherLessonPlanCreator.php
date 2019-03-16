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
<link rel="stylesheet" type="text/css" href="public/css/lessonplan.css"/> 
<!-- scripts -->
<script src="public/js/admin_lessonplanForTeacher.js"></script>


<!-- panel box -->
<div id="container">

    <h1 class='center_me' style='margin-bottom: 10px;'>Lesson plan creator for teacher</h1>
    <?php
    // include src/Builder/flashMessage
    include_once("src/Builder/flashMessage.php");
    ?>
    <div id="lessonplan_nav">

        Select Teacher:
        <select id="teacherSelect" name='teacherID'>
        </select>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Description:
        <input type='text' name="description">

        <br/><br/>

        Select Date From:
        <input type='date' name='date_from'>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Select Date To:
        <input type='date' name='date_to'>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button onclick='addNewPlan()'>Add this lesson plan</button>

    </div>


    <div id="lessonplan_container">

        <div id="hours_container">
            <div class='nav_info'></div>
        </div>

        <div id="lessons_container">

        </div>

    </div>
</div>

