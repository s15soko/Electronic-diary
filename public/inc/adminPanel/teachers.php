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
$teachers = $userDataController->getAllTeachers();
?>



<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultSearchForm.css"/>
<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/rowsColor.js"></script>
<script src="public/js/searchUser.js"></script>



<!-- panel box -->
<div id="container">

    <div id="table_options">
        <button onclick="deleteRows('teachers', 'ajax_teachers-update');">Set as student</button>
        <button onclick="searchUser();">Search</button>
    </div>

    <div id="searchForm"></div>
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
            <form id="teachers_form">
                <?php 
                if($teachers)
                {
                    foreach ($teachers as $key => $teacher) 
                    {
                        echo "<tr class='users_row'>";
                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='teachers' value='$teacher[id]'/> 
                                <button><a class='btn-link' href='?ap=user&id=$teacher[id]'>Edit</a></button>
                            </td>";
                            echo "<td class='center_me'>$teacher[imie]</td>";
                            echo "<td class='center_me userSurname'>$teacher[nazwisko]</td>";
                            echo "<td class='center_me'>$teacher[rola_uzytkownika]</td>";
                            echo "<td class='center_me'>$teacher[email]</td>";
                            echo "<td class='center_me darker_td'>$teacher[PIN]</td>";
                            echo "<td class='center_me'>$teacher[adres]</td>";
                            echo "<td class='center_me'>$teacher[kontakt]</td>";
                            echo "<td class='center_me'>$teacher[data_urodzenia]</td>";
                            echo "<td class='center_me darker_td'>$teacher[login]</td>";
                            echo "<td class='center_me darker_td'>$teacher[role]</td>";
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