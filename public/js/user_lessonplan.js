// global variable for all teachers
var g_TEACHERS = Array();
// global variable for all subjects
var g_SUBJECTS = Array();

// load default
$(document).ready(function()
{
    getHours();
    getAllTeachers();
    getAllSubjects();
    setEmptyFields();   
});


// get date
function getDate()
{
    var myDate = new Date();
    var year = myDate.getUTCFullYear();
    var month = myDate.getUTCMonth() + 1;
    var day = myDate.getUTCDate();

    if(day < 10) day = "0" + day;
    if(month < 10) month = "0" + month;
    var dateStr = year + "-" + month + "-" + day;

    return dateStr;
}

// get lesson plan
function getLessonPlan()
{
    var myDate = getDate().toString();
    var groupID = $("#selectGroup option:selected").attr("value");

    var lessonPlan;
    // get lesson plan by date
    $.ajax({
        type: "POST",
        async: false,
        dataType: "json",
        data: ({
            datefrom: myDate,
            dateto: myDate,
            groupid: groupID
        }),
        url: "public/ajax/user/get/ajax_lessonPlan-get.php",
        success: function(data)
        {
            lessonPlan = data;           
        }
    }); 
    return lessonPlan;
}

// get hours by ajax
function getHours()
{
    // array for hours 
    var hours = Array();
    
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "public/ajax/user/get/ajax_hoursLesson-get.php",
        success: function(data)
        {
            hours = data;

            // find by id
            var hours_container = document.getElementById("hours_container");
            
            data.forEach(element => 
            {
                // create element
                var div = document.createElement("div");
                div.setAttribute("class", "h_box");
                div.innerHTML = element['hour_from'];
                hours_container.appendChild(div);  

            });
        }
    });
    return hours;
}

// get all teachers by ajax
function getAllTeachers()
{
    // get all teachers
    $.ajax({
        type: "POST",
        dataType: "json",
        async: false,
        url: "public/ajax/user/get/ajax_teachers-get.php",
        success: function(data)
        {
            // add options
            data.forEach(element => 
            {
                g_TEACHERS.push(element);
            });
            
        }
    }); 
}
// get all subjects by ajax
function getAllSubjects()
{
    // get all teachers
    $.ajax({
        type: "POST",
        dataType: "json",
        async: false,
        url: "public/ajax/user/get/ajax_subjects-get.php",
        success: function(data)
        {
            // add options
            data.forEach(element => 
            {
                g_SUBJECTS.push(element);
            });
            
        }
    }); 
}


function setEmptyFields()
{
    var plan = getLessonPlan();
    var lessonplan = JSON.parse(plan["lessons"]);
    

    var lessons_container = document.getElementById("lessons_container");
    var days = {0: "Monday", 1: "Tuesday", 2: "Wednesday", 3: "Thursday", 4: "Friday"};

    // array for lesson containers
    var lesson_container = Array();
    // array for 1 row (1 lesson)
    var l_box = Array();

    // i as day
    for(var i = 0; i < 5; i++)
    {
        // create lesson container (1 column for 1 day)
        lesson_container[i] = document.createElement("div");
        lesson_container[i].setAttribute("class", "lesson_container");
        lesson_container[i].setAttribute("data-day", i);
        // create data div for this lesson container
        var nav_info = document.createElement("div");
        nav_info.setAttribute("class", 'nav_info');
        // set day name
        nav_info.innerHTML = days[i];

        // append elements
        lesson_container[i].appendChild(nav_info);
        lessons_container.appendChild(lesson_container[i]);

        var flag = false;

        // i represents day
        Object.keys(lessonplan[i]).forEach(function(hour)
        {
            //console.log(hour, lessonplan[i][hour]);

            l_box[hour]= document.createElement("div");
            l_box[hour].setAttribute("class", "l_box");
            
            // if is set subject
            if(lessonplan[i][hour]["s"])
            {
                flag = true;

                g_SUBJECTS.forEach(subject => 
                {
                    // check fo subject
                    if(subject["id"] == lessonplan[i][hour]["s"])
                    {
                        var s_div = document.createElement("div");
                        s_div.setAttribute("class", "subject");
                        s_div.innerHTML = subject["name"];
                            
                        l_box[hour].appendChild(s_div);
                    }
                });
            }
            // if is set teacher
            if(lessonplan[i][hour]["t"])
            {
                // for each teacher
                g_TEACHERS.forEach(teacher => 
                {
                    // check teacher data
                    if(teacher['id'] == lessonplan[i][hour]["t"])
                    {
                        var t_div = document.createElement("div");
                        t_div.setAttribute("class", "teacher");
                        t_div.innerHTML = teacher["name"] + " " + teacher["surname"];
                        
                        l_box[hour].appendChild(t_div);
                    }
                });
            }


            if(lessonplan[i][hour]["i"])
            {
                var i_div = document.createElement("div");
                i_div.setAttribute("class", "info");
                i_div.innerHTML = lessonplan[i][hour]["i"]
                        
                l_box[hour].appendChild(i_div);
            }

            if(flag === true)
            {
                l_box[hour].style.backgroundColor = "#E0FFA3";
                flag = false;
            }else l_box[hour].style.backgroundColor = "#F7F3F4";
            
            
            lesson_container[i].appendChild(l_box[hour]);
        });
      
    }
}
