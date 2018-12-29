<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsAdmin())
{
    header("location: index.php");
    exit();
}


// include src/Controller/classController
require_once("src/Controller/classController.php");
$classController = new classController();
$classes = $classController->getClasses();

?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>
<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/classes.js"></script>



<!-- panel box -->
<div id="container">

    <div id="table_options">
        <button onclick="deleteRows('classes', 'ajax_classes-delete');">Usuń zaznaczone</button>
        <button onclick="classFormBuilder();">Dodaj nowy semestr</button>
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
                <th>Numer</th>
                <th>Nazwa</th>
            </tr>
        </thead>
        <tbody>
            <form id="directions_form">
                <?php 
                if($classes)
                {
                    foreach ($classes as $key => $class) 
                    {
                        echo "<tr>";
                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='classes' value='$class[id]'/> 
                                <button><a class='btn-link' href='?ap=class&id=$class[id]'>Edytuj</a></button>
                            </td>";
                            echo "<td class='center_me'>$class[numer]</td>";
                            echo "<td class='center_me'>$class[nazwa]</td>";
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