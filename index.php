<?php
// include src/Manager/sessionManager
include_once(getcwd() ."/src/Manager/sessionManager.php");

$session = new sessionManager();
if($session->checkIfIsActiveUserSession())
{
    $showPanel = true;
}else $showPanel = false;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dziennik Elektryczny</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- styles -->
        <link rel="stylesheet" type="text/css" href="public/css/index.css"/>
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <!-- scripts -->
        <!--<script src="public/js/index.js"></script>-->
    </head>
<body>

<main id="main_container">

    <?php
    if($showPanel)
    {  
        header("Location: userPanel.php");
    }
    else 
    {
        include_once("loginPanel.php");
    }
    ?>
    
</main>

</body>
</html>
