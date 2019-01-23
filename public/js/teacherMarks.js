// return user id by ajax
function returnUserId()
{
    var userId;
    // start ajax
    // get user id
    $.ajax({
        type: "POST",
        dataType: "json",
        async: false,
        url: "public/ajax/user/get/ajax_userID-get.php",
        success: function(data)
        {
            userId = data;
        }
    });
    return userId;
}
// check user role
function returnUserRole()
{
    var userRole;
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        async: false,
        url: "public/ajax/mod/get/ajax_userRole-get.php",
        success: function(data)
        {
            userRole = data;
        }
    });
    return userRole;
}
// get all subjects for group
// for director
function getSubjectsForGroup(group)
{
    var subjects;
    // start ajax
    // get all marks
    $.ajax({
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            id: group,
        }),
        url: "public/ajax/admin/get/ajax_getGroupSubjects.php",
        success: function(data)
        {
            subjects = data;
        }
    });
    return subjects;
}
// get subjects for teacher
function getTeacherSubjects(userId)
{
    var subjects;
    // start ajax
    // get all marks
    $.ajax({
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            id: userId,
        }),
        url: "public/ajax/mod/get/ajax_teacherSubjects-get.php",
        success: function(data)
        {
            subjects = data;
        }
    });

    return subjects;
}
// get subjects for teacher
function getGroupUsers(group)
{
    var subjects;
    // start ajax
    // get all marks
    $.ajax({
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            id: group,
        }),
        url: "public/ajax/mod/get/ajax_groupUsers-get.php",
        success: function(data)
        {
            subjects = data;
        }
    });
    
    return subjects;
}
// get user marks by term id and subject id
function getUserMarks(term, subject)
{
    var marks;
    // start ajax
    // get all marks
    $.ajax({
        type: "POST",
        dataType: "json",
        async: false,
        data: ({
            term: term,
            subject: subject
        }),
        url: "public/ajax/mod/get/ajax_getUsersMarksByTermSubject-get.php",
        success: function(data)
        {
            marks = data;
        }
    });

    return marks;
}
// insert options for subject select
function insertOptionsForSubjects(subjects)
{
    // box for subjects
    $subjectsBox = $("#subjectID");
    
    subjects.forEach(subject => 
    {
        var option = document.createElement("option");
        $option = $(option);
            
        $option.attr("data-subject_id", subject['id']);
        $option.attr("value", subject['id']);
        $option.text(subject['name']);
    
        $subjectsBox.append($option);
    });
}


// load default data for
// teacher 
$(document).ready(function()
{
    // box for our results
    $resultBox = $("#resultsBox"); 
    // get choosen group
    var groupID = $("#groupID option:selected").attr("data-group_id");
    var checkUserRole = returnUserRole();

    // if administrator (director)
    // load all subjects for group
    if(checkUserRole === "ADMINISTRATOR")
    {
        // get group subjects by ajax
        var subjectsForTeacher = getSubjectsForGroup(groupID);

        insertOptionsForSubjects(subjectsForTeacher);
    }
    // else load subjects for teacher
    else
    {
        // get group subjects by ajax
        var subjectsForTeacher = getTeacherSubjects(returnUserId());

        insertOptionsForSubjects(subjectsForTeacher);
    }

    // get selected option from terms
    var termSelect = $("#termID option:selected").attr("data-term_id");
    // get users from group
    var groupUsers = getGroupUsers(groupID);
    
    createUsersTable(termSelect, groupUsers);
});

// create users table
function createUsersTable(term, users)
{
    // clean data in results box
    $students_container = $resultBox.find("#students_container");
    if($students_container)
    {
        $students_container.each(function(index)
        {
            this.remove();
        })
    }

    // new data
    students_container = document.createElement("div");
    $students_container = $(students_container);
    $students_container.attr("id","students_container");
    $resultBox.append($students_container);

    // get choosen subject id
    var subjectID = $("#subjectID option:selected").attr("data-subject_id");
    var userMarks = getUserMarks(term, subjectID);
    
    var counter = 1;
    // foreach user
    users.forEach(user => 
    {
        // student row
        student_row = document.createElement("div");
        $student_row = $(student_row);
        $student_row.attr("class","student_row");
        $students_container.append($student_row);

        // student data
        student_data = document.createElement("div");
        $student_data = $(student_data);
        $student_data.attr("class","student_data");
        $student_row.append($student_data);
            // std number
            std_number = document.createElement("div");
            $std_number = $(std_number);
            $std_number.attr("class","std_number");
            $std_number.text(counter);
            $student_data.append($std_number);
            // std checkbox
            std_checkbox = document.createElement("div");
            $std_checkbox = $(std_checkbox);
            $std_checkbox.attr("class","std_checkbox");
            $student_data.append($std_checkbox);
                // checkbox input
                checkbox = document.createElement("input");
                $checkbox = $(checkbox);
                $checkbox.attr("type","checkbox");
                $checkbox.attr("name","user_checkbox");
                $checkbox.attr("value", user['student_id']);
                $std_checkbox.append($checkbox);
            // std name
            std_name = document.createElement("div");
            $std_name = $(std_name);
            $std_name.attr("class","std_name");
            $std_name.text(user['name'] + " " + user['surname'] );
            $student_data.append($std_name);

        // student marks
        student_marks = document.createElement("div");
        $student_marks = $(student_marks);
        $student_marks.attr("class","student_marks");
        $student_row.append($student_marks);
        
        if(userMarks !== undefined)
        {
            userMarks.forEach(mark => 
                {
                    if(user['student_id'] == mark['student_id'])
                    {
                        std_mark = document.createElement("div");
                        $std_mark = $(std_mark);
                        $std_mark.attr("class","std_mark");
                        $std_mark.text(mark['user_grade']);
                        $student_marks.append($std_mark);
                    }
                });
        }
        
        counter++;
    });
    
}



// load data on change
function loadData()
{
    // get selected option from terms/ school years
    var schoolYear = $("#termID option:selected").attr("data-year_id");
    var termSelect = $("#termID option:selected").attr("data-term_id");
    // get choosen group
    var groupID = $("#groupID option:selected").attr("data-group_id");

    // get users from group
    var groupUsers = getGroupUsers(groupID);
   
    createUsersTable(termSelect, groupUsers);
}


// add new grade
function addNewGrade()
{
    var schoolYearID = $("#termID option:selected").attr("data-year_id");
    var termID = $("#termID option:selected").attr("data-term_id");
    var subjectID = $("#subjectID option:selected").attr("data-subject_id");
    var gradeWeight = document.getElementsByName("weight")[0].value;
    var gradeRange = document.getElementsByName("range")[0].value;
    var gradeTypeID = $("#gradeType option:selected").attr("value");
    var gradeID = $("#grade option:selected").attr("value");

    var ROWS = document.getElementsByName("user_checkbox");
    var users = new Array();

    // check which one row is checked -> save to array
    ROWS.forEach(element => 
    {
        if(element.checked === true)
        {
            // if is checked push to table users
            users.push(element.value);
        }
    });

    

    if(users.length > 0)
    {
        var teacherID = returnUserId();
        
        // start ajax
        $.ajax({
            type: "post",
            url: "public/ajax/mod/ajax_newGrade-add.php",
            data: ({
                users: users,
                teacherID: teacherID,
                schoolYearID: schoolYearID,
                termID: termID,
                subjectID: subjectID,
                gradeWeight: gradeWeight,
                gradeRange: gradeRange,
                gradeTypeID: gradeTypeID,
                gradeID: gradeID
            }),
            success: function()
            {
                
                window.location.href = "?mp=marks";
            }
        });
    }
    


}