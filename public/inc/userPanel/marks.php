<?php
// include src/Manager/sessionManager
require_once("src/Manager/sessionManager.php");
$session = new sessionManager();


if(!$session->checkIfIsActiveUserSession())
{
    header("Location: index.php");
    exit();
}

// get user id 
$user_id = $session->returnUserId();


// include src/Controller/schoolYearController 
require_once("src/Controller/schoolYearController.php");
$schoolYearController = new schoolYearController();
// take all school year ex. (2018/2019...)
$schoolYears = $schoolYearController->returnAllschoolYears();

// include src/Controller/termsController 
require_once("src/Controller/termsController.php");
$termsController = new termsController();

// include src/Controller/schoolController 
require_once("src/Controller/schoolController.php");
$schoolController = new schoolController();
// take current school year id and actual term id
$school = $schoolController->schoolInformation("current_school_year_id, current_term_id");

?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/umarks.css"/>
<!-- scripts -->
<script src="public/js/marks.js"></script>
<script src="public/js/rowsColor.js"></script>





<!-- panel box -->
<div id="container">

    <h1>Student card</h1>

    <h3>Term</h3>
    <select id='termSelect' onchange='loadMarksData()'>
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

    <div id="marks_container">

    </div>


</div>

