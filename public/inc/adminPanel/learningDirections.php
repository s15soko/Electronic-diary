<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsAdmin())
{
    header("location: index.php");
    exit();
}


// include src/Controller/learningDirectionController
require_once("src/Controller/learningDirectionController.php");
$learningDirectionController = new learningDirectionController();
$directions = $learningDirectionController->getLearningDirections();
?>



<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>
<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/learningDirections.js"></script>




<!-- panel box -->
<div id="container">

    <div id="table_options">
        <button onclick="deleteRows('directions', 'ajax_learningDirections-delete')">Delete selected</button>
        <button onclick="directionsFormBuilder();">Add new term</button>
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
                <th>Term name</th>
                <th>Short name</th>
            </tr>
        </thead>
        <tbody>
            <form id="directions_form">
                <?php 
                if($directions)
                {
                    foreach ($directions as $key => $direction) 
                    {
                        echo "<tr>";
                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='directions' value='$direction[id]'/> 
                                <button><a class='btn-link' href='?ap=direction&id=$direction[id]'>Edit</a></button>
                            </td>";
                            echo "<td>$direction[name]</td>";
                            echo "<td class='center_me'>$direction[short_name]</td>";
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

