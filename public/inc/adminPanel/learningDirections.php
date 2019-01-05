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
        <button onclick="deleteRows('directions', 'ajax_learningDirections-delete')">Usuń zaznaczone</button>
        <button onclick="directionsFormBuilder();">Dodaj nowy kierunek</button>
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
                <th>Nazwa kierunku</th>
                <th>Krótka nazwa</th>
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
                                <button><a class='btn-link' href='?ap=direction&id=$direction[id]'>Edytuj</a></button>
                            </td>";
                            echo "<td>$direction[nazwa_kierunku]</td>";
                            echo "<td class='center_me'>$direction[krotka_nazwa]</td>";
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

