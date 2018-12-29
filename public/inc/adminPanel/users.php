<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../../src/Manager/sessionManager.php");
$session = new sessionManager();
if(!$session->checkIfIsAdmin())
{
    header("location: index.php");
    exit();
}

// include src/Controller/userDataController
require_once("src/Controller/userDataController.php");
$userDataController = new userDataController();
$users = $userDataController->getAllUsers();
?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>
<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/users.js"></script>
<script src="public/js/rowsColor.js"></script>


<!-- panel box -->
<div id="container">

    <div id="table_options">
        <button onclick="deleteRows('users', 'ajax_users-delete');">Usuń zaznaczone</button>
        <button onclick="userFormBuilder();">Dodaj nowego uzytkownika</button>
        <button>Wyszukaj</button>
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
                <th>Imie</th>
                <th>Nazwisko</th>
                <th>Rola</th>
                <th>Email</th>
                <th class='darker_th'>PIN</th>
                <th>Adres</th>
                <th>Kontakt</th>
                <th>Data urodzenia</th>
                <th>Login</th>
                <th>role</th>
            </tr>
        </thead>
        <tbody>
            <form id="terms_form">
                <?php 
                if($users)
                {
                    foreach ($users as $key => $user) 
                    {
                        echo "<tr class='users_row'>";

                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='users' value='$user[id]'/> 
                                <button><a class='btn-link' href='?ap=user&id=$user[id]'>Edytuj</a></button>
                            </td>";

                            echo "<td class='center_me'>$user[imie]</td>";
                            echo "<td class='center_me'>$user[nazwisko]</td>";
                            echo "<td class='center_me'>$user[rola_uzytkownika]</td>";
                            echo "<td class='center_me'>$user[email]</td>";
                            echo "<td class='center_me darker_td'>$user[PIN]</td>";
                            echo "<td class='center_me'>$user[adres]</td>";
                            echo "<td class='center_me'>$user[kontakt]</td>";
                            echo "<td class='center_me'>$user[data_urodzenia]</td>";
                            echo "<td class='center_me darker_td'>$user[login]</td>";
                            echo "<td class='center_me darker_td'>$user[role]</td>";

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

<script>
colorMyRows("users_row");
</script>