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
<link rel="stylesheet" type="text/css" href="public/css/terms.css"/>
<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/terms.js"></script>



<!-- panel box -->
<div id="container">

    <div id="table_options">
        <button onclick="deleteRows('terms', 'ajax_terms-delete');">Usuń zaznaczone</button>
        <button onclick="termsFormBuilder();">Dodaj nowy semestr</button>
    </div>

    <div id="newForm"></div>

    <?php
    if(isset($_SESSION['flashMessage']))
    {
        echo "<span style='color: red; padding: 5px;'>". $_SESSION['flashMessage'] . "</span>";
        unset($_SESSION['flashMessage']);
    }
    ?>

    <table>
        <thead>
            <tr>
                <th class="short_th">Opcje</th>
                <th>Rok szkolny</th>
                <th>Data od</th>
                <th>Data do</th>
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
                                <button><a class='btn-link' href='?ap=term&id=$term[id]'>Edytuj</a></button>
                            </td>";
                            echo "<td class='center_me'>$term[rok_szkolny]</td>";
                            echo "<td class='center_me'>$term[data_od]</td>";
                            echo "<td class='center_me'>$term[data_do]</td>";
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
