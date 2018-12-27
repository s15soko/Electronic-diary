<?php
// include sessionManager
require_once(getcwd() . "/src/Manager/sessionManager.php");
$session = new sessionManager();

if(!$session->checkIfIsActiveUserSession())
{
    Header("Location: index.php");
    exit();
}

// include schoolController
require_once(getcwd() . "/src/Controller/schoolController.php");
// include userDataController
require_once(getcwd() . "/src/Controller/userDataController.php");

?>

<html>
<head>
    <title>User Panel</title>
    <!-- styles -->
    <link rel="stylesheet" type="text/css" href="public/css/nav_bar.css"/> 
    <link rel="stylesheet" type="text/css" href="public/css/userPanel.css"/> 
    <link rel="stylesheet" type="text/css" href="public/css/default.css"/> 
    <link rel="stylesheet" type="text/css" href="public/css/confirmWin.css"/> 
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <!-- scripts -->
    <script src="public/js/jQuery.js"></script>

</head>
<body>
    <?php
    // show nav bar
    include_once(getcwd() ."/public/inc/userPanel/nav_bar.php");
    ?>

    <div id="panel_container">

        <div id="panel">

            <div id="panel_menu">
                
                <ul>

                    <a href='index.php'><li title="Strona główna">Strona główna</li></a>
                    <?php       
                    // show admin options 
                    if($_SESSION['role'] === "ADMINISTRATOR")
                    {
                        ?>
                            <a href="?ap=terms"><li title="Semestry">Semestry</li></a>
                            <a href="?ap=directions"><li title="Kierunki">Kierunki</li></a>
                            <a href="?ap=classes"><li title="Klasy">Klasy</li></a>
                            <a href="?ap=users"><li title="Uzytkownicy">Uzytkownicy</li></a>
                            <a href="?ap=subjects"><li title="Przedmioty">Przedmioty</li></a>
                        <?php
                    }
                    // show user options
                    if($_SESSION['role'] === "USER")
                    {
                        ?>
                            <a href="?up=marks"><li>Oceny</li></a>
                        <?php
                    }
                    ?>
                    
                </ul>
    
            </div>
        
            <div id="panel_box">

                    <?php
                    // include src/Controller/methodGETController.php
                    include_once("src/Controller/methodGETController.php");
                    ?>



                    <h1>Witaj!</h1>
                    <?php
                        echo "<br/>";
                        echo $_SESSION['user'];
                        echo "<br/>";
                        echo $_SESSION['id_user'];
                        echo "<br/>";
                        echo $_SESSION['role'];
                        echo "<pre>";
                        print_r(scandir(session_save_path()));
                    ?>


            </div>
        </div>
    </div>
</body>
</html>

