<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsActiveUserSession())
{
    header("location: index.php");
    exit();
}
if($_SESSION['role'] === "USER")
{
    header("location: index.php");
    exit();
}

// include src/Controller/schoolController 
require_once("src/Controller/schoolController.php");
$schoolController = new schoolController();
// take current school year id and actual term id
$school = $schoolController->schoolInformation("current_school_year_id, current_term_id");

// include src/Controller/schoolYearController 
require_once("src/Controller/schoolYearController.php");
$schoolYearController = new schoolYearController();
// take all school year ex. (2018/2019...)
$schoolYears = $schoolYearController->returnAllschoolYears();

// include src/Controller/termsController 
require_once("src/Controller/termsController.php");
$termsController = new termsController();


// include src/Controller/groupsController
require_once("src/Controller/groupsController.php");
$groupsController = new groupsController();
$allGroups = $groupsController->getGroups();


// include src/Controller/subjectController
require_once("src/Controller/subjectController.php");
$subjectController = new subjectController();
?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/marks.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>

<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/teacherMarks.js"></script>


<!-- panel box -->
<div id="container">

    <h1 style='margin-bottom: 25px;'>Tachers card</h1>

    <div id="teacher_panel">
        <div class="grade_box_data">
            Select term:
            <select id='termID' onchange='loadData()'>
            <?php
            foreach($schoolYears as $key => $year)
            {  
                echo "<option data-year_id='$year[id]' data-term_id='null'>$year[school_year]</option>";
                // get terms by school id ^
                $terms = $termsController->getTermsByID($year['id']);

                foreach($terms as $key => $term)
                {       
                    if($term['id'] === $school['current_term_id'])
                    {
                        echo "<option data-year_id='$year[id]' data-term_id='$term[id]' selected>
                            &nbsp;&nbsp;&nbsp;$term[name]</option>";
                        continue;
                    }

                    echo "<option data-year_id='$year[id]' data-term_id='$term[id]'>
                            &nbsp;&nbsp;&nbsp;$term[name]</option>";    
                }  
            }
            ?>
            </select>
            <br/><br/>
            Select group:
            <select id='groupID' onchange='loadData()'>
                <?php
                foreach ($allGroups as $key => $group) 
                {
                    echo "<option data-group_id='$group[id]' value='$group[id]'>$group[name]</option>";
                }
                ?>
            </select>
            <br/><br/>
            Select subject:
            <select id='subjectID' onchange='loadData()'>
            </select>
        </div>
        <div class="grade_box_data2">
            Weight:
            <input type='number' name='weight' placeholder='Grade weight'>
            Range:
            <input type='text' name='weight' placeholder='Grade range'>
            Type:
            <select id='gradeType'>
                <?php
                // include src/Controller/marksController 
                require_once("src/Controller/marksController.php");
                $marksController = new marksController();
                $types = $marksController->getGradeTypes();
                foreach ($types as $key => $type) 
                {
                    echo "<option value='$type[id]'>$type[type]</option>";
                }
                ?>
            </select>
        </div>
        <div class="grade_box_data3">
                Add grade
                <input type="submit" value="add" name="submit" onclick="addNewGrade();">
        </div>
    </div>
    
    <div id='resultsBox'>
    </div>

</div>
