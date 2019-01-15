<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsAdmin())
{
    header("location: index.php");
    exit();
}


// include src/Controller/schoolYearController
require_once("src/Controller/schoolYearController.php");
$schoolYearController = new schoolYearController();
$schoolYears = $schoolYearController->returnAllschoolYears();
?>



<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>
<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/schoolYears.js"></script>



<!-- panel box -->
<div id="container">

    <div id="table_options">
        <button onclick="deleteRows('schoolyears', 'ajax_schoolYears-delete')">Delete selected</button>
        <button onclick="schoolYearFormBuilder();">Add new school year</button>
    </div>

    <div id="newForm"></div>

    <?php
    if(isset($_SESSION['flashMessage']))
    {
        echo "<span class='flash_message'>". $_SESSION['flashMessage'] . "</span>";
        unset($_SESSION['flashMessage']);
    }
    ?>

    <table>
        <thead>
            <tr>
                <th class="short_th">Options</th>
                <th>School year</th>
                <th>Date from</th>
                <th>Date to</th>
            </tr>
        </thead>
        <tbody>
            <form id="schoolYears_form">
                <?php 
                if($schoolYears)
                {
                    foreach ($schoolYears as $key => $schoolYear) 
                    {
                        echo "<tr>";
                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='schoolyears' value='$schoolYear[id]'/> 
                                <button><a class='btn-link' href='?ap=schoolYear&id=$schoolYear[id]'>Edit</a></button>
                            </td>";
                            echo "<td class='center_me'>$schoolYear[rok_szkolny]</td>";
                            echo "<td class='center_me'>$schoolYear[data_od]</td>";
                            echo "<td class='center_me'>$schoolYear[data_do]</td>";
                        echo "</tr>";
                    }
                }
                else {
                    echo "No data!";
                }
                ?>
            </form>   
        </tbody>
    </table>

</div>


