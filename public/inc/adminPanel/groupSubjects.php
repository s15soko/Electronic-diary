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




<!-- panel box -->
<div id="container">

    <h1 class='center_me' style='margin-bottom: 25px;'>Dodaj przedmiot do grupy</h1>

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
                <th>Nazwa</th>
                <th class='short_th'>Grupa</th>
                <th>Klasa</th>
                <th>Kierunek</th>
            </tr>
        </thead>
        <tbody>
            <form id="groupSubjects_form">
                <?php 
                if($groups)
                {
                    foreach ($groups as $key => $group) 
                    {
                        echo "<tr>";
                            echo "<td class='form_input-options'> 
                                <button style='width: 100%;'><a class='btn-link' href='?ap=editGroupSubjects&id=$group[id]'>Pokaz</a></button>
                            </td>";
                            echo "<td class='center_me'>$group[nazwa]</td>";
                            echo "<td class='center_me'>$group[grupa]</td>";
                            echo "<td class='center_me'>$group[rok_szkolny_numer] - $group[rok_szkolny_nazwa]</td>";
                            echo "<td class='center_me'>$group[nazwa_kierunku]</td>";
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