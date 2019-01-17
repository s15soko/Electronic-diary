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

<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>
<script src="public/js/teacherSubjects.js"></script>




<!-- panel box -->
<div id="container">

    <div id="table_options">
        <button onclick="deleteRows('teacherSubjects', 'ajax_teacherSubjects-delete');">Delete rights to subject</button>
        <button onclick="teacherSubjectFormBuilder();">Add subject for teacher</button>
    </div>

    <div id="newForm"></div>

    <?php
    // include src/Builder/flashMessage
    include_once("src/Builder/flashMessage.php");
    ?>

    <?php 
    if($teachers)
    {
        foreach ($teachers as $key => $teacher) 
        {
            // continue if role == administrator/admin
            if($teacher['school_role'] === "DIRECTOR")
            {
                continue;
            }
            ?>
            <table>
                <thead>
                    <tr>
                        <th class="short_th">Options</th>
                        <th>  
                            <?php 
                            echo $teacher['name'];
                            echo " ";
                            echo $teacher['surname'];
                            echo " -- PIN: " . $teacher['PIN'];
                            ?>
                        </th>
                    </tr>
                </thead>
                <tbody id=<?php echo $teacher['id']; ?>>
                
                </tbody>
            </table>
            <?php         
        }
    }
    ?>

</div>

<script>
    getAllTeachersSubjects();
</script>