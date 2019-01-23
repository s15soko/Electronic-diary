
// return user subjects
function returnUserSubjects(myAjaxResults)
{
    // array for user subjects
    var userSubjects = Array();
    var flag = false;

    // find all user subjects
    myAjaxResults.forEach(res => 
    {
        // if array is empty
        if(userSubjects == 0)
        {
            // push first element
            userSubjects.push(res['name']);
        }
        else // if isnt empty
        {
            flag = false;
    
            userSubjects.forEach(sub => 
            {
                // if subject exist in array
                if(sub == res['name'])
                    flag = true; // set flag on true
            });

            // if flag == false
            // push new subject
            if(!flag)
            {
                userSubjects.push(res['name']);
            }
        }
    });

    //return array
    return userSubjects;
}


function subjectAverage(subject, myAjaxResults, userGroupName, userId)
{
    // average for marks
    var schoolWholeAverage = 0;
    var classWholeAverage = 0;
    var userWholeAverage = 0;
    // counters
    var count_school = 0;
    var count_class = 0;
    var count_user = 0;

    // for each row from results
    myAjaxResults.forEach(element => 
    {
        // for first element
        // average for all subjects
        if(subject == "General average")
        {
            // for school
            schoolWholeAverage += ((element['value'] * element['weight'])/element['weight']);

            // for class
            if(element['groupname'] == userGroupName[0])
            {
                classWholeAverage += ((element['value'] * element['weight'])/element['weight']);
                count_class++;
            }

            // for user
            if(element['student_id'] == userId)
            {
                userWholeAverage += ((element['value'] * element['weight'])/element['weight']);

                count_user++;
            }

            count_school++;
        }
        // average for one subject
        else if(element['name'] == subject)
        {
            // for school
            schoolWholeAverage += ((element['value'] * element['weight'])/element['weight']);

            // for class
            if(element['groupname'] == userGroupName[0])
            {
                classWholeAverage += ((element['value'] * element['weight'])/element['weight']);
                count_class++;
            }

            // for user
            if(element['student_id'] == userId)
            {
                userWholeAverage += ((element['value'] * element['weight'])/element['weight']);

                count_user++;
            }

            count_school++;
        }
    });

    // 'round up' to two place after the comma
    schoolAverage = (schoolWholeAverage/count_school).toFixed(2);
    classAverage = (classWholeAverage/count_class).toFixed(2);
    userAverage = (userWholeAverage/count_user).toFixed(2);   

    // create container
    avgContainer = document.createElement("div");
    $avgContainer = $(avgContainer);
    // set attr
    $avgContainer.attr("class", "avgContainer");

    // create div for subject name
    ma_box_subject = document.createElement("div");
    $ma_box_subject = $(ma_box_subject);
    $ma_box_subject.attr("class", "ma_box-subject");
    // set name for this container
    $ma_box_subject.text(subject);

    // create div for subjects average data
    ma_box = document.createElement("div");
    $ma_box = $(ma_box);
    $ma_box.attr("class", "ma_box");


    // for school, class and user
    var rowValue = {0: "School:", 1: "Class:", 2: "You:"};
    // assign 
    var average = {0: schoolAverage, 1: classAverage, 2: userAverage}

    // if average for user is NaN (no marks)
    // set as 0
    for(i = 0; i < 3; i++)
    {
        if(isNaN(average[i]))
            average[i] = 0.00;
    }
    

    // arrays
    var row = Array();
    var $row = Array();
    var rowinfo = Array();
    var $rowinfo = Array();
    var rowdata = Array();
    var $rowdata = Array();


    var i = 0;
    // set box rows
    // row for: school average marks
    // class average marks
    // user average marks
    for(i = 0; i < 3; i++)
    {
        row[i] = document.createElement("div");
        $row[i] = $(row[i]);
        $row[i].attr("class", "box-row");
        rowinfo[i] = document.createElement("div");
        $rowinfo[i] = $(rowinfo[i]);
        $rowinfo[i].attr("class", "row-info");
        $rowinfo[i].text(rowValue[i]);
        rowdata[i] = document.createElement("div");
        $rowdata[i] = $(rowdata[i]);
        $rowdata[i].attr("class", "row-data");
        $rowdata[i].text(average[i] + " / 6.00");
    }

    // arrays
    var belt = Array();
    var $belt = Array();

    var i = 0;
    for(i = 0; i < 3; i++)
    {
        // create belts
        belt[i] = document.createElement("div");
        $belt[i] = $(belt[i]);
        $belt[i].attr("class", "belt");
    }

    // append subject average container
    // to main box (resultBox) 
    $resultBox.append($avgContainer);

    // append other div's
    $avgContainer.append($ma_box_subject);
    $avgContainer.append($ma_box);

    for(i = 0; i < 3; i++)
    {
        $ma_box.append($row[i]);
        $row[i].append($rowinfo[i]);
        $row[i].append($rowdata[i]);
        $rowdata[i].append($belt[i]);
    }

    // get div width 
    x =  $rowdata[0].width();

    // set info belts
    for(i = 0; i < 3; i++)
    {
        $belt[i].attr("style", "width: " + (((average[i]*100)/x)*100) + "%;");    
    }


}


// return user id by ajax
function returnUserId()
{
    var userId;
    // start ajax
    // get user id
    $.ajax({
        type: "POST",
        async: false,
        url: "public/ajax/user/get/ajax_userID-get.php",
        success: function(data)
        {
                userId = data;
        }
    });

    return userId;
}

// return marks by ajax
function returnAllMarks()
{
    var myAjaxResults;
    // start ajax
    // get all marks
    $.ajax({
        type: "POST",
        async: false,
        data: ({
            termid: $termSelect,
            schoolyearid: $schoolYear
        }),
        url: "public/ajax/user/get/ajax_allMarks-get.php",
        success: function(data)
        {
            myAjaxResults = data;
        }
    });
    return myAjaxResults;
}

// returnuser group name by ajax
function returnUserGroupName()
{
    var userGroupName;
    // start ajax
    // get user group name
    $.ajax({
        type: "POST",
        async: false,
        data: ({
            userid: $userId,
        }),
        url: "public/ajax/user/get/ajax_userGroupName-get.php",
        success: function(data)
        {
            userGroupName = data;
        }
    });
    return userGroupName;
}


// load default data
$(document).ready(function()
{
    // box for our results
    $resultBox = $("#resultsBox");
    
    // get selected option from terms/ school years
    $schoolYear = $("#termSelect option:selected").attr("data-year_id");
    $termSelect = $("#termSelect option:selected").attr("data-term_id");

    // get choosen type of results
    $typeOfResults = $("#typeOfResults option:selected").attr("data-name");


    // user id 
    $userId = returnUserId();
    // results (marks)
    $myAjaxResults = returnAllMarks();
    // user group name
    $userGroupName = returnUserGroupName();

    // parse to array
    $userGroupName = JSON.parse($userGroupName);
    // parse to array
    $myAjaxResults = JSON.parse($myAjaxResults);
    
    // user subjects
    $userSubjects = returnUserSubjects($myAjaxResults);

    
    // if user pick term and marks 
    if($termSelect && $typeOfResults === 'marks')
    {
        
        $userSubjects.unshift("General average");
        // average for each subject
        $userSubjects.forEach(sub => 
        {
            
            subjectAverage(sub, $myAjaxResults, $userGroupName, $userId);
        });
        
    } // end if
});


// load data on change
function loadData()
{
    // clean data in results box
    $containers = $resultBox.find(".avgContainer")
    if($containers)
    {
        $containers.each(function(index)
        {
            this.remove();
        })
    }
    
    // get selected option from terms/ school years
    $schoolYear = $("#termSelect option:selected").attr("data-year_id");
    $termSelect = $("#termSelect option:selected").attr("data-term_id");

    // get choosen type of results
    $typeOfResults = $("#typeOfResults option:selected").attr("data-name");


    if(!isNaN($termSelect))
    {
        $myAjaxResults = returnAllMarks();
        // parse to array
        $myAjaxResults = JSON.parse($myAjaxResults);
    }
    
    // if type of results == marks
    if($typeOfResults == 'marks')
    {
        // if user pick term
        if(!isNaN($termSelect))
        {
            // average for each subject
            $userSubjects.forEach(sub => 
            {
                subjectAverage(sub, $myAjaxResults, $userGroupName, $userId);
            });
            
        } 

        // if user pick rank for school year (ex. 2019/2020)
        if($schoolYear && isNaN($termSelect))
        {
            console.log("school");
        }
    }
    // if type of results == attendance
    if($typeOfResults == 'attendance')
    {
        console.log('attendance');
    }
}