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
        <button onclick="deleteRows('subjects', 'ajax_subjects-delete')">Usuń zaznaczone</button>
        <button onclick="subjectFormBuilder();">Dodaj nowy przedmiot</button>
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
                <th>Nazwa</th>
            </tr>
        </thead>
        <tbody>
            <form id="directions_form">
                <?php 
                if($subjects)
                {
                    foreach ($subjects as $key => $subject) 
                    {
                        echo "<tr>";
                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='subjects' value='$subject[id]'/> 
                                <button><a class='btn-link' href='?ap=subject&id=$subject[id]'>Edytuj</a></button>
                            </td>";
                            echo "<td class='center_me'>$subject[kolejnosc]</td>";
                            echo "<td class='center_me'>$subject[krotka_nazwa]</td>";
                            echo "<td class='center_me'>$subject[nazwa]</td>";
                        echo "</tr>";
                    }
                }
                else {
                    echo "Brak polaczenia z baza!";
                }
                ?>
            </form>   
        </tbody>
    </table>

</div>
