<?php
// include src/Manager/sessionManager
include_once(dirname(__FILE__)."/../../src/Manager/sessionManager.php");
$session = new sessionManager();

// check GET for user with admin roles/privilege 
if($session->checkIfIsAdmin())
{
    //gets array
    $GETS = array(
        "studentLessonPlanCreator" => "studentLessonPlanCreator.php",
        "groupSubjects" => "groupSubjects.php",
        "userGroup" => "userGroup.php",
        "teacherSubjects" => "teacherSubjects.php",
        "teachers" => "teachers.php",
        "users" => "users.php",
        "addNewUser" => "addNewUser.php",

        "schoolyears" => "schoolYears.php",
        "terms" => "terms.php",
        "classes" => "classes.php",
        "groups" => "groups.php",
        "directions" => "learningDirections.php",
        "subjects" => "subjects.php",

        // GET for edit
        "editGroupSubjects" => "edit/editGroupSubjects.php",
        "editUserGroup" => "edit/editUserGroup.php",
        // teacher subject no edit page
        // teacher => editUser
        "user" => "edit/editUser.php",

        "schoolYear" => "edit/editSchoolYear.php",
        "term" => "edit/editTerm.php",
        "class" => "edit/editClass.php", 
        "group" => "edit/editGroup.php",
        "direction" => "edit/editLearningDirection.php",
        "subject" => "edit/editSubject.php"
    );
    // GET for admin panel
    if(isset($_GET["ap"]))
    {
        $link = $_GET['ap'];

        // foreach for ap get
        foreach($GETS as $key => $GET)
        {
            if($key === $link)
            {
                // include file 
                include("public/inc/adminPanel/".$GET);
                exit();
            }
            else 
            {
                // 
            }
        }
    }
}


// check GET for moderator or admin
if($session->checkIfIsModerator() || $session->checkIfIsAdmin())
{
    //gets array
    $GETS = array(
        "marks" => "marks.php",
        "presences" => "presences.php",
        "lessonplan" => "lessonPlan.php"
        
    );
    // GET for admin panel
    if(isset($_GET["mp"]))
    {
        $link = $_GET['mp'];

        // foreach for ap get
        foreach($GETS as $key => $GET)
        {
            if($key === $link)
            {
                // include file 
                include("public/inc/modPanel/".$GET);
                exit();
            }
            else 
            {
                // 
            }
        }
    }  
}



// check GET for user...
//gets array
$user_GETS = array(
    "marks" => "marks.php",
    "lessonplan" => "lessonPlan.php",
    "ranking" => "ranking.php",
    "messages" => "messages.php",
    
    // other
    "sent_messages" => "sent_messages.php",
    "my_messages" => "my_messages.php"
);
// GET for user panel
if(isset($_GET["up"]))
{
    $link = $_GET['up'];

    // foreach for ap get
    foreach($user_GETS as $key => $GET)
    {
        if($key === $link)
        {
            // include file 
            include("public/inc/userPanel/".$GET);
            exit();
        }
        else 
        {
            // 
        }
    }
}
?>