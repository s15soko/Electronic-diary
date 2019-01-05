<?php
// check if is set $_GET[id]
if(isset($_GET['id']))
{
    // save to id
    $id = $_GET['id'];
    
}
else 
{
    // 
    header("");
    exit();
}


// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsAdmin())
{
    header("location: index.php");
    exit();
}


// include src/Controller/groupsController
require_once("src/Controller/groupsController.php");
$groupsController = new groupsController();
$subjects = $groupsController->getGroupSubjects($id);

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
        <button onclick="deleteRows('groupSubjects', 'ajax_groupSubjects-delete');">Usuń przedmiot z grupy</button>
        <button data-groupid='<?php echo $id; ?>' onclick="groupSubjectFormBuilder(this.getAttribute('data-groupid'));">Dodaj przedmiot do grupy</button>
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
                <th class="short_th">Opcje</th>
                <th>Kolejność</th>
                <th>Krótka nazwa</th>
                <th>nazwa</th>
            </tr>
        </thead>
        <tbody>
            <form id="groupSubjects_form">
                <?php 
                if($subjects)
                {
                    foreach ($subjects as $key => $subject) 
                    {
                        echo "<tr class='userInGroup'>";

                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='groupSubjects' value='$subject[id]'/> 
                            </td>";

                            echo "<td class='center_me'>$subject[kolejnosc]</td>";
                            echo "<td class='center_me'>$subject[krotka_nazwa]</td>";
                            echo "<td class='center_me'>$subject[nazwa]</td>";

                        echo "</tr>";
                        
                    }
                }
                else {
                    echo "Brak danych!";
                }
                ?>
            </form>   
        </tbody>
    </table>


</div>