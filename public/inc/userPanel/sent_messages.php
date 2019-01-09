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
$sentMessages = $messageController->showUserSentMessages($userid);

?>


<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/defaultTable.css"/>
<!-- scripts -->
<script src="public/js/confirmWin.js"></script>
<script src="public/js/deleteRows.js"></script>



<!-- panel box -->
<div id="container">

    <h1 class='center_me' style='margin-bottom: 25px;'>Twoja skrzynka nadawcza</h1>

    <div id="table_options">
        <button onclick="deleteRows('userSentMessages', 'ajax_sentMessages-delete');">Usuń zaznaczone</button>
    </div>

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
                <th>Odbiorca</th>
                <th>Temat</th>
                <th>Data wysłania</th>
            </tr>
        </thead>
        <tbody>
            <form id="messages_form">
                <?php 
                if($sentMessages)
                {
                    foreach ($sentMessages as $key => $message) 
                    {
                        echo "<tr>";
                            echo "<td class='form_input-options'> 
                                <input type='checkbox' name='userSentMessages' value='$message[id]'/> 
                            </td>";

                            echo "<td style='width: 100px;'>$message[imie] $message[nazwisko]</td>";
                            echo "<td title='$message[zawartosc]'>$message[temat]</td>";
                            echo "<td style='width: 82px;'>$message[data]</td>";

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