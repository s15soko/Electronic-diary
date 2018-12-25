<?php
// include src/Manager/sessionManager
require_once("src/Manager/sessionManager.php");
$session = new sessionManager();

// get user id
$user_id = $session->returnUserId();

// include src/Controller/subjectController
//require_once("src/Controller/subjectController.php");
//$subjectController = new subjectController();
//$userSubjects = $subjectController->getUserSubjects($user_id);

?>



<!-- styles -->
<link rel="stylesheet" type="text/css" href="public/css/marksTable.css"/>
<!-- scripts -->
<script src="public/js/confirmWin.js"></script>




<!-- panel box -->
<div id="container">

    <script>


    function userSubjects(data)
    {
        var table = JSON.parse(data);
    }

    var url1 = "public/ajax/user/ajax_returnUserID.php";
    var url2 = "public/ajax/user/ajax_userSubjects.php";
    $.ajax({
    type: "POST",
    url: url1,
    success: function(userid) 
    {
            $.ajax({
                type: "POST",
                url: url2,    
                data: ({id: userid}),
                success: function(data)
                {
                    userSubjects(data);             
                }
            });
    }
    });

    
    </script>
    
    



</div>



