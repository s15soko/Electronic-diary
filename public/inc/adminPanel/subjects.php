<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsAdmin())
{
    header("location: index.php");
    exit();
}


// include src/Controller/subjectController
require_once("src/Controller/subjectController.php");
$subjectController = new subjectController();
$subjects = $subjectController->getSubjects();

?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>
<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/subjects.js"></script>



<!-- panel box -->
<div id="container">

    <div id="table_options">
        <button onclick="deleteRows('subjects', 'ajax_subjects-delete')">Delete selected</button>
        <button onclick="subjectFormBuilder();">Add new subject</button>
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
                <th>Order</th>
                <th>short name</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <form id="subjects_form">
                <?php 
                if($subjects)
                {
                    foreach ($subjects as $key => $subject) 
                    {
                        echo "<tr>";
                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='subjects' value='$subject[id]'/> 
                                <button><a class='btn-link' href='?ap=subject&id=$subject[id]'>Edit</a></button>
                            </td>";
                            echo "<td class='center_me'>$subject[order]</td>";
                            echo "<td class='center_me'>$subject[short_name]</td>";
                            echo "<td class='center_me'>$subject[name]</td>";
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
