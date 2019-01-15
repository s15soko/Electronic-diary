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
<link rel="stylesheet" type="text/css" href="public/css/defaultSearchForm.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>
<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/searchUser.js"></script>
<script src="public/js/rowsColor.js"></script>



<!-- panel box -->
<div id="container">

    <div id="table_options">
        <button onclick="deleteRows('users', 'ajax_users-delete');">Delete selected</button>
        <button><a href='?ap=addNewUser'>Add new user</a></button>
        <button onclick='searchUser();'>Search</button>
    </div>

    <div id="searchForm"></div>
    <div id="newForm"></div>

    <?php
    // include src/Builder/flashMessage
    include_once("src/Builder/flashMessage.php");
    ?>


    <table>
        <thead>
            <tr>
                <th class="short_th">Options</th>
                <th>Name</th>
                <th>Surname</th>
                <th>School role</th>
                <th>E-mail</th>
                <th class='darker_th'>PIN</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Date of birth</th>
                <th>Login</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <form id="users_form">
                <?php 
                if($users)
                {
                    foreach ($users as $key => $user) 
                    {
                        echo "<tr class='users_row'>";

                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='users' value='$user[id]'/> 
                                <button><a class='btn-link' href='?ap=user&id=$user[id]'>Edit</a></button>
                            </td>";

                            echo "<td class='center_me'>$user[imie]</td>";
                            echo "<td class='center_me userSurname'>$user[nazwisko]</td>";
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
                    echo "No data!";
                }
                ?>
            </form>   
        </tbody>
    </table>
</div>

<script>
colorMyRows("users_row");
</script>

