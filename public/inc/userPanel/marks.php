<?php
// include src/Manager/sessionManager
require_once("src/Manager/sessionManager.php");
$session = new sessionManager();

// get user id 
$user_id = $session->returnUserId();

// include src/Controller/subjectController
require_once("src/Controller/subjectController.php");
$subjectController = new subjectController();
// user subjects
$userSubjects = $subjectController->getUserSubjects($user_id);

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
$school = $schoolController->schoolInformation("obecny_rok_szkolny, obecny_semestr");

// include src/Controller/marksController 
require_once("src/Controller/marksController.php");
$marksController = new marksController();
?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/umarks.css"/>
<!-- scripts -->
<script src="public/js/marks.js"></script>
<script src="public/js/rowsColor.js"></script>



<!-- panel box -->
<div id="container">

    <h1>Karta ucznia</h1>


    <h3>Semestr</h3>
    <select onchange='changeTerm(this);'>
        <?php    
        // variable for user marks 
        $userMarks;


        $checkGET = $marksController->checkGET();
        // foreach year in our school ex. (2018/2019...)
        foreach($schoolYears as $key => $year)
        {  
            if(!$checkGET)
            {
                echo "<option data-year_id='$year[id]' data-term_id='null'>$year[rok_szkolny]</option>";
                // get terms by school id ^
                $terms = $termsController->getTermsByID($year['id']);

                // get data to variable $userMarks
                $userMarks = $marksController->getUserMarksByTermID($school['obecny_semestr'] ,$user_id);

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
            else // get term and year
            {
                if($checkGET['term'] === 'null')
                {
                    exit();
                }
                else 
                {
                    echo "<option data-year_id='$year[id]' data-term_id='null'>$year[rok_szkolny]</option>";
                    // get terms by school id ^
                    $terms = $termsController->getTermsByID($year['id']);

                    // get data to variable $userMarks
                    $userMarks = $marksController->getUserMarksByTermID($checkGET['term'] ,$user_id);

                    foreach ($terms as $key => $term) 
                    {
                        echo "<option data-year_id='$year[id]' data-term_id='$term[id]'>
                        &nbsp;&nbsp;&nbsp;$term[semestr]</option>"; 
                    }
                }                
            }
            
        }
        ?>
    </select>


    <div id="marks_container">

        <div id="marks_header">
            <div class='header_text_box'>
                <div class='subject_box-header_short'>
                    Przedmiot
                </div>
            </div>
        </div>

        <div id="marks_body">
            <?php
            // show subjects 
            foreach ($userSubjects as $key => $subject) 
            {
                echo "<div class='marks_row'>";

                    echo "<div class='subject_box'>";
                        echo "<span>$subject[nazwa]</span>";
                    echo "</div>";

                    echo "<div class='marks_box'>";
                        foreach ($userMarks as $key => $mark) 
                        {
                            if($subject['id'] === $mark['przedmiot'])
                            {
                                echo "<div class='mark' style='color: $mark[color]'
                                    data-mark='$mark[ocena]'
                                    data-desc='$mark[nazwa_oceny]'
                                    data-kind='$mark[rodzaj]'
                                    data-range='$mark[zakres]'
                                    data-data='$mark[data]'
                                    data-weight='$mark[waga_oceny]'
                                    onmouseover='showMarkInformation(this);'>$mark[ocena]</div>";
                            }
                        }
                    echo "</div>";

                    echo "<div class='last_mark_box'>";
                        echo "<div class='mark'>";

                        echo "</div>";
                    echo "</div>";

                echo "</div>";   
            }
            ?> 
            
        </div>
    </div>
</div>

<script>
colorMyRows("marks_row");
</script>