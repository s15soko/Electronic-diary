<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsAdmin())
{
    header("location: index.php");
    exit();
}


// include src/Controller/termsController
require_once("src/Controller/termsController.php");
$termsController = new termsController();
$terms = $termsController->getTerms();
?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>

<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/terms.js"></script>



<!-- panel box -->
<div id="container">

    <div id="table_options">
        <button onclick="deleteRows('terms', 'ajax_terms-delete');">Delete selected</button>
        <button onclick="termFormBuilder();">Add new term</button>
    </div>

    <div id="newForm"></div>

    <?php
    // include src/Builder/flashMessage
    include_once("src/Builder/flashMessage.php");
    ?>

    <table>
        <thead>
            <tr>
                <th class="short_th">Options</th>
                <th>School year</th>
                <th>Term</th>
                <th>Date from</th>
                <th>Date to</th>
            </tr>
        </thead>
        <tbody>
            <form id="terms_form">
                <?php 
                if($terms)
                {
                    foreach ($terms as $key => $term) 
                    {
                        echo "<tr>";
                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='terms' value='$term[id]'/> 
                                <button><a class='btn-link' href='?ap=term&id=$term[id]'>Edit</a></button>
                            </td>";
                            echo "<td class='center_me'>$term[school_year]</td>";
                            echo "<td class='center_me'>$term[name]</td>";
                            echo "<td class='center_me'>$term[date_from]</td>";
                            echo "<td class='center_me'>$term[date_to]</td>";
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
