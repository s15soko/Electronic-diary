<?php
// include src/Manager/sessionManager
require_once("src/Manager/sessionManager.php");
$session = new sessionManager();

if(!$session->checkIfIsActiveUserSession())
{
    header("Location: index.php");
    exit();
}

$userid = $session->returnUserId();


// include src/Controller/messageController
require_once("src/Controller/messageController.php");
$messageController = new messageController();
$inbox = $messageController->showUserInbox($userid);

?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>

<!-- panel box -->
<div id="container">

    <h1 class='center_me' style='margin-bottom: 25px;'>Your inbox</h1>

    <div id="table_options">
        <button onclick="deleteRows('userInbox', 'ajax_inboxMessages-delete');">Delete selected</button>
    </div>

    <?php
    // include src/Builder/flashMessage
    include_once("src/Builder/flashMessage.php");
    ?>


    <table>
        <thead>
            <tr>
                <th class="short_th">Options</th>
                <th>Sender</th>
                <th>Title</th>
                <th>Received date</th>
            </tr>
        </thead>
        <tbody>
            <form id="messages_form">
                <?php 
                if($inbox)
                {
                    foreach ($inbox as $key => $message) 
                    {
                        echo "<tr>";
                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='userInbox' value='$message[id]'/> 
                            </td>";

                            echo "<td style='width: 100px;'>$message[name] $message[surname]</td>";
                            echo "<td title='$message[content]'>$message[title]</td>";
                            echo "<td style='width: 82px;'>$message[date]</td>";

                        echo "</tr>";
                    }
                }
                else {
                    //
                }
                ?>
            </form>   
        </tbody>
    </table>

</div>