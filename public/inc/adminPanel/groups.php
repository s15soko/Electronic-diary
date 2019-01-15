<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsAdmin())
{
    header("location: index.php");
    exit();
}


// include src/Controller/groupsController
require_once("src/Controller/groupsController.php");
$groupsController = new groupsController();
$groups = $groupsController->getGroups();
?>



<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>

<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/groups.js"></script>



<!-- panel box -->
<div id="container">

    <div id="table_options">
        <button onclick="deleteRows('groups', 'ajax_groups-delete');">Delete selected</button>
        <button onclick="groupFormBuilder();">Add new group</button>
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
                <th>Name</th>
                <th class='short_th'>Group</th>
                <th>Class</th>
                <th>Direction</th>
            </tr>
        </thead>
        <tbody>
            <form id="groups_form">
                <?php 
                if($groups)
                {
                    foreach ($groups as $key => $group) 
                    {
                        echo "<tr>";
                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='groups' value='$group[id]'/> 
                                <button><a class='btn-link' href='?ap=group&id=$group[id]'>Edit</a></button>
                            </td>";
                            echo "<td class='center_me'>$group[nazwa]</td>";
                            echo "<td class='center_me'>$group[grupa]</td>";
                            echo "<td class='center_me'>$group[rok_szkolny_numer] - $group[rok_szkolny_nazwa]</td>";
                            echo "<td class='center_me'>$group[nazwa_kierunku]</td>";
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
