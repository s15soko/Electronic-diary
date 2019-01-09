<?php
// include src/Manager/sessionManager
require_once("src/Manager/sessionManager.php");
$session = new sessionManager();

if(!$session->checkIfIsActiveUserSession())
{
    header("Location: index.php");
    exit();
}

// get user id
$userid = $session->returnUserId();
?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<link rel="stylesheet" type="text/css" href="public/css/defaultNewForm.css"/>
<!-- scripts -->
<script src="public/js/message.js"></script>



<!-- panel box -->
<div id="container">
    
    <style>
        #table_options
        {
            display:flex; 
            flex-direction: column; 
            height: 150px;
        }
        button
        {
            height: 40px;
            margin: 4px 0;
        }
        button a
        {
            color: white;
            text-decoration: none;
        }

    </style>

    <div id='newForm' data-userid='<?php echo $userid; ?>'></div>

    <?php
    if(isset($_SESSION['flashMessage']))
    {
        echo "<span class='flash_message'>". $_SESSION['flashMessage'] . "</span>";
        unset($_SESSION['flashMessage']);
    }
    ?>

    <div id="table_options">



        <?php if(!$session->checkIfIsAdmin() && !$session->checkIfIsModerator())
        {
            ?>
                <button onclick="newMessageFormBuilderForUser();" style='padding: 10px 0;'>Wyslij nową wiadomość</button>
            <?php
        }
        else
        {
            ?>
                <button onclick="newMessageFormBuilderForTeacher(); style='padding: 10px 0;'">Wyslij nową wiadomość</button>
            <?php
        }
        ?>
        


        <button><a href='?up=sent_messages'>Wyslane wiadomosci</a></button>
        <button><a href='?up=my_messages'>Skrzynka odbiorcza</a></button>
    </div>


</div>