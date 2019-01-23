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
$users = $groupsController->getGroupUsers($id);


?>




<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultSearchForm.css"/>

<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/rowsColor.js"></script>
<script src="public/js/groups.js"></script>
<script src="public/js/searchUser.js"></script>



<!-- panel box -->
<div id="container">

    <div id="table_options">
        <button onclick="deleteRows('userGroup', 'ajax_userGroup-delete');">Delete student from group</button>
        <button onclick="userGroupFormBuilder();">Add student to group</button>
        <button onclick="searchUser('userInGroup');">Search</button>
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
                <th class='darker_th'>PIN</th>
            </tr>
        </thead>
        <tbody>
            <form id="userInGroup_form">
                <?php 
                if($users)
                {
                    foreach ($users as $key => $user) 
                    {
                        echo "<tr class='userInGroup'>";

                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='userGroup' value='$user[id]'/> 
                                <button><a class='btn-link' href='?ap=user&id=$user[id]'>Edit</a></button>
                            </td>";

                            echo "<td class='center_me'>$user[name]</td>";
                            echo "<td class='center_me userSurname'>$user[surname]</td>";
                            echo "<td class='center_me'>$user[school_role]</td>";
                            echo "<td class='center_me darker_td'>$user[PIN]</td>";

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
colorMyRows("userInGroup");
</script>