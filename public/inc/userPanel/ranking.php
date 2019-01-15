<?php
// include src/Manager/sessionManager
require_once("src/Manager/sessionManager.php");
$session = new sessionManager();

if(!$session->checkIfIsActiveUserSession())
{
    header("Location: index.php");
    exit();
}


// include src/Controller/rankingController
require_once("src/Controller/rankingController.php");
$rankingController = new rankingController();

// include src/Controller/schoolController 
require_once("src/Controller/schoolController.php");
$schoolController = new schoolController();
// take current school year id and actual term id
$school = $schoolController->schoolInformation("obecny_rok_szkolny, obecny_semestr");

// include src/Controller/schoolYearController 
require_once("src/Controller/schoolYearController.php");
$schoolYearController = new schoolYearController();
// take all school year ex. (2018/2019...)
$schoolYears = $schoolYearController->returnAllschoolYears();

// include src/Controller/termsController 
require_once("src/Controller/termsController.php");
$termsController = new termsController();

?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/ranking.css"/>
<!-- scripts -->
<script src="public/js/ranking.js"></script>


<!-- panel box -->
<div id="container">

    <h1 style='text-align: center; margin-bottom: 20px;'>Ranking</h1>

    <h3>Classification period:</h3>
    <select id='termSelect' onchange='loadData()'>
    <?php
    foreach($schoolYears as $key => $year)
    {  
        echo "<option data-year_id='$year[id]' data-term_id='null'>$year[rok_szkolny]</option>";
        // get terms by school id ^
        $terms = $termsController->getTermsByID($year['id']);

        foreach($terms as $key => $term)
        {       
            if($term['id'] === $school['obecny_semestr'])
            {
                echo "<option data-year_id='$year[id]' data-term_id='$term[id]' selected>
                    &nbsp;&nbsp;&nbsp;$term[semestr]</option>";
                continue;
            }

            echo "<option data-year_id='$year[id]' data-term_id='$term[id]'>
                    &nbsp;&nbsp;&nbsp;$term[semestr]</option>";    
        }  
    }
    ?>
    </select>

    <br/><br/>

    <h3>Type of results:</h3>
    <select id='typeOfResults' onchange='loadData()'>
        <option data-name='marks'>Current marks - weighted average</option>
        <option data-name='attendance'>Frequency</option>
    </select>


    <div id='resultsBox'>
        
    </div>


</div>