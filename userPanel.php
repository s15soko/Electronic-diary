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
<body onload='displayClock();'>
    <?php
    // show nav bar
    include_once(getcwd() ."/public/inc/nav_bar.php");
    ?>

    <div id="panel_container">

        <div id="panel">

            <div id="panel_menu">
                
                <ul>

                    <a href='index.php'><li title="Strona główna">Strona główna</li></a>
                    <?php    
                    // show moderator options (+for ADMINISTRATOR)
                    if($_SESSION['role'] === "MODERATOR" || $_SESSION['role'] === "ADMINISTRATOR")
                    {
                        ?>
                        <li style='background-color: #C7C7C7; font-size: 15px;'>Opcje nauczyciela</li>
                            <a href="?mp=marks"><li title="Wpisz ocene">Wpisz ocene</li></a>
                            <a href="?mp=presences"><li title="Obecności">Obecności</li></a>
                            <a href="?up=messages"><li title="Wiadomści">Wiadomości</li></a>
                        <?php
                    }
                    // show ADMINISTRATOR options 
                    if($_SESSION['role'] === "ADMINISTRATOR")
                    {
                        ?>
                            <li style='background-color: #C7C7C7; font-size: 15px; margin-top: 55px;'>Opcje administratora</li>
                            <a href="?ap=groupSubjects"><li title="Przedmioty dla grupy">Przedmioty dla grupy</li></a>
                            <a href="?ap=userGroup"><li title="Uczeń w grupie">Uczeń w grupie</li></a>
                            <a href="?ap=teacherSubjects"><li title="Przedmioty dla nauczyciela">Przedmioty dla nauczyciela</li></a>
                            <a href="?ap=teachers"><li>Nauczyciele</li></a>
                            <a href="?ap=users"><li title="Uzytkownicy">Uzytkownicy</li></a>

                            <li style='background-color: #C7C7C7; font-size: 15px; margin-top: 55px;'>Dodatkowe opcje administratora</li>
                            <a href="?ap=schoolyears"><li title="Rok szkolny">Rok szkolny</li></a>
                            <a href="?ap=terms"><li title="Semestry">Semestry</li></a>
                            <a href="?ap=classes"><li title="Klasy">Klasy</li></a> 
                            <a href="?ap=groups"><li title="Grupy">Grupy</li></a>         
                            <a href="?ap=directions"><li title="Kierunki">Kierunki</li></a>
                            <a href="?ap=subjects"><li title="Przedmioty">Przedmioty</li></a> 
                            
                        <?php
                    }
                    // show USER options
                    if($_SESSION['role'] === "USER")
                    {
                        ?>
                            <a href="?up=marks"><li title="Oceny">Oceny</li></a>
                            <a href="?up=lessonplan"><li title="Plan lekcji">Plan lekcji</li></a>
                            <a href="?up=ranking"><li title="Ranking">Ranking</li></a>
                            <a href="?up=messages"><li title="Wiadomści">Wiadomości</li></a>
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
                        echo $_SESSION['schoolrole'];
                        echo "<pre>";
                        print_r(scandir(session_save_path()));
                    ?>


            </div>
        </div>
    </div>
</body>
</html>

