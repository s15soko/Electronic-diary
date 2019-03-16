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


<!DOCTYPE html>
<head>
    <title>User Panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='keywords' content='electronic, diary, school'>
    <meta name='author' content='Arkadiusz Chmenia'>
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

<!-- displayClock() function in nav_bar.php -->
<body onload='displayClock();'>
    <?php
    // show nav bar
    include_once(getcwd() ."/public/inc/nav_bar.php");
    ?>

    <div id="panel_container">

        <div id="panel">

            <div id="panel_menu">
                
                <ul>

                    <a href='index.php'><li title="Home">Home</li></a>
                    <?php    
                    // show moderator options (+for ADMINISTRATOR)
                    if($_SESSION['role'] === "MODERATOR" || $_SESSION['role'] === "ADMINISTRATOR")
                    {
                        ?>
                        <li style='background-color: #C7C7C7; font-size: 14px;'>Teacher options</li>
                            <a href="?mp=marks"><li title="Enter the mark">Enter the mark</li></a>
                            <a href="?mp=presences"><li title="Presences">Presences</li></a>
                            <a href="?up=messages"><li title="Messages">Messages</li></a>
                            <a href="?mp=lessonplan"><li title="Lesson plan">Lesson plan</li></a>
                        <?php
                    }
                    // show ADMINISTRATOR options 
                    if($_SESSION['role'] === "ADMINISTRATOR")
                    {
                        ?>
                            <li style='background-color: #C7C7C7; font-size: 14px; margin-top: 40px;'>Administrator options</li>
                            <a href="?ap=studentLessonPlanCreator"><li title="Lesson Plan Creator for student">Student Lesson Plan Creator</li></a>
                            <a href="?ap=teacherLessonPlanCreator"><li title="Lesson Plan Creator for teacher">Teacher Lesson Plan Creator</li></a>
                            <a href="?ap=LessonPlans"><li title="All lesson plans">All lesson plans</li></a>
                            <a href="?ap=groupSubjects"><li title="Subjects for group">Subjects for group</li></a>
                            <a href="?ap=userGroup"><li title="Stundent in group">Stundent in group</li></a>
                            <a href="?ap=teacherSubjects"><li title="Subjects for teacher">Subjects for teacher</li></a>
                            <a href="?ap=teachers"><li title="Teachers">Teachers</li></a>
                            <a href="?ap=users"><li title="Users">Users</li></a>

                            <li style='background-color: #C7C7C7; font-size: 14px; margin-top: 40px;'>Additional options</li>
                            <a href="?ap=schoolyears"><li title="School years">School years</li></a>
                            <a href="?ap=terms"><li title="Terms">Terms</li></a>
                            <a href="?ap=classes"><li title="Classes">Classes</li></a> 
                            <a href="?ap=groups"><li title="Groups">Groups</li></a>         
                            <a href="?ap=directions"><li title="Directions">Directions</li></a>
                            <a href="?ap=subjects"><li title="Subjects">Subjects</li></a> 
                            
                        <?php
                    }
                    // show USER options
                    if($_SESSION['role'] === "USER")
                    {
                        ?>
                            <a href="?up=marks"><li title="Marks">Marks</li></a>
                            <a href="?up=lessonplan"><li title="Lesson plan">Lesson plan</li></a>
                            <a href="?up=ranking"><li title="Ranking">Ranking</li></a>
                            <a href="?up=messages"><li title="Messages">Messages</li></a>
                        <?php
                    }
                    ?>
                    
                </ul>
    
            </div>
        
            <div id="panel_box">

                    <?php
                    // include src/Controller/methodGETController.php
                    include_once(dirname(__FILE__)."/src/Controller/methodGETController.php");
                    ?>

                    <p><h1>Hello!</h1></p>
                    <p>Nice to see you here!</p>



            </div>

        </div>
    </div>
</body>
</html>

