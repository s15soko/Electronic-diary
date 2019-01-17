// global variable for all teachers
var g_TEACHERS = Array();
// global variable for all subjects
var g_SUBJECTS = Array();

// load default
// 1) get hours
// 2) set empty fields
// 3) get all term
// 4) get all classes
// 4) get all groups
$(document).ready(function()
{
    // start ajax
    // get all teachers
    $.ajax({
        type: "POST",
        dataType: "json",
        async: false,
        url: "public/ajax/admin/get/ajax_teachers-get.php",
        success: function(data)
        {
            // add options
            data.forEach(element => 
            {
                g_TEACHERS.push(element);
            });
            
        }
    }); 
    // start ajax
    // get all subjects
    $.ajax({
        type: "POST",
        dataType: "json",
        async: false,
        url: "public/ajax/admin/get/ajax_subjects-get.php",
        success: function(data)
        {
            // add options
            data.forEach(element => 
            {
                g_SUBJECTS.push(element);
            });
            
        }
    }); 


    // 1*
    var hours = getHours();
    // 2*
    setEmptyFields(hours);
    // 3*
    getAllTerms();
    // 4*
    getAllClasses();
    // 5*
    getAllGroups();
});

// set empty fields to choose the lesson
// and teacher for this lesson
function setEmptyFields(hours)
{
    var lessons_container = document.getElementById("lessons_container");
    var days = {0: "Monday", 1: "Tuesday", 2: "Wednesday", 3: "Thursday", 4: "Friday"};

    // array for lesson containers
    var lesson_container = Array();
    // array for 1 row (1 lesson)
    var l_box = Array();

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


        for(var j = 0; j < hours.length; j++)
        {
            l_box[j]= document.createElement("div");
            l_box[j].setAttribute("class", "l_box");
            l_box[j].setAttribute("data-hour", hours[j]['id']);

            // first select for subject
            s1 = document.createElement("select");
            s1.setAttribute("class", "selectSubject");
            s1.setAttribute("name", "subjectID");

            // select for teacher
            s2 = document.createElement("select");
            s2.setAttribute("class", "selectTeacher");
            s2.setAttribute("name", "teacherID");

            l_box[j].appendChild(s1);
            l_box[j].appendChild(s2);
            lesson_container[i].appendChild(l_box[j]);


            // get teachers for this row
            getAllTeachers(lesson_container[i].getAttribute("data-day"), j);

            // get subjects for this row
            getAllSubjects(lesson_container[i].getAttribute("data-day"), j);
        }        
    }
}


// get all teachers by ajax
function getAllTeachers(day, lesson_number)
{
    var lesson_container = document.querySelectorAll(".lesson_container")[day];
    var row = lesson_container.querySelectorAll(".l_box")[lesson_number];

    var selTeacher = row.querySelector(".selectTeacher");
    var opt = document.createElement("option");
    opt.setAttribute("hidden", "true");
    opt.setAttribute("selected", "true");
    opt.setAttribute("disabled", "true");
    opt.innerHTML = "Select teacher";
    selTeacher.appendChild(opt);

    g_TEACHERS.forEach(element =>
    {
        opt = document.createElement("option");
        opt.setAttribute("data-teacherID", element['id']);
        opt.innerHTML = element['name'] + " " + element['surname'];

        selTeacher.appendChild(opt);
    });
}
// get all teachers by ajax
function getAllSubjects(day, lesson_number)
{
    var lesson_container = document.querySelectorAll(".lesson_container")[day];
    var row = lesson_container.querySelectorAll(".l_box")[lesson_number];

    var selSubject = row.querySelector(".selectSubject");
    var opt = document.createElement("option");
    opt.setAttribute("hidden", "true");
    opt.setAttribute("selected", "true");
    opt.setAttribute("disabled", "true");
    opt.innerHTML = "Select subject";
    selSubject.appendChild(opt);

    g_SUBJECTS.forEach(element =>
    {
        opt = document.createElement("option");
        opt.setAttribute("data-subjectID", element['id']);
        opt.innerHTML = element['name'];

        selSubject.appendChild(opt);
    });
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
        async: false,
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
                var span = document.createElement("span");
                span.innerHTML = element['name'];

                div.appendChild(span);
                hours_container.appendChild(div);  
            });
        }
    });

    // return array
    return hours;
}


// get terms by ajax 
function getAllTerms()
{
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "public/ajax/admin/get/ajax_terms-get.php",
        success: function(data)
        {
            // find by id
            var termSelect = document.getElementById("termSelect");
            
            // add options
            data.forEach(element => 
            {
                // create element
                var opt = document.createElement("option");
                opt.setAttribute("value", element['id']);
                opt.innerHTML = element['name'];
                termSelect.appendChild(opt);
            });
        }
    });
    
}
// get classes by ajax 
function getAllClasses()
{
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "public/ajax/admin/get/ajax_classes-get.php",
        success: function(data)
        {
            // find by id
            var classSelect = document.getElementById("classSelect");
            
            // add options
            data.forEach(element => 
            {
                // create element
                var opt = document.createElement("option");
                opt.setAttribute("value", element['id']);
                opt.innerHTML = element['number'] + " - " + element['name'];
                classSelect.appendChild(opt);
            });
        }
    });
    
}
// get groups by ajax 
function getAllGroups()
{
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "public/ajax/admin/get/ajax_groups-get.php",
        success: function(data)
        {
            // find by id
            var groupSelect = document.getElementById("groupSelect");
            
            // add options
            data.forEach(element => 
            {
                // create element
                var opt = document.createElement("option");
                opt.setAttribute("value", element['id']);
                opt.innerHTML = element['name'] + ", g: " + element['group'];
                groupSelect.appendChild(opt);
            });
        }
    });
    
}

// add new plan
// convert to array in json
function addNewPlan()
{
    var myLessonArray = {};

    var lesson_containers = document.querySelectorAll(".lesson_container");
    
    var counter = 0;
    lesson_containers.forEach(element => 
    {
        // get day number
        var day = element.getAttribute("data-day");
        // get all lessons in 1 day
        var lessons = {};
        
        var allLessons = element.querySelectorAll(".l_box");
        allLessons.forEach(el => 
        {
            // get teacher id
            var select = el.querySelectorAll(".selectTeacher")[0];
            selectedTeacher = select.options[select.selectedIndex].getAttribute("data-teacherid");

            // get subject id
            select = el.querySelectorAll(".selectSubject")[0];
            selectedSubject = select.options[select.selectedIndex].getAttribute("data-subjectid");

            // take lesson hour
            var hour = el.getAttribute("data-hour");


            lessons[hour] = {"t": selectedTeacher, "s": selectedSubject};
        });


        myLessonArray[day] = lessons;
        counter++;
    });
 
myLessonArray = JSON.stringify(myLessonArray);

// get other values
var term = document.getElementById("termSelect").value;
var userclass = document.getElementById("classSelect").value;
var group = document.getElementById("groupSelect").value;
var term = document.getElementById("termSelect").value;
var desc = document.getElementsByName("description")[0].value;
var datef = document.getElementsByName("date_from")[0].value;
var datet = document.getElementsByName("date_to")[0].value;


// start ajax
// start ajax
$.ajax({
    type: "post",
    url: "public/ajax/admin/ajax_userLessonPlan-add.php",
    data: ({
        term: term,
        userclass: userclass,
        group: group,
        term: term,
        desc: desc,
        datef: datef,
        datet: datet,
        lessonplan: myLessonArray,
    }),
    success: function()
    {
        console.log(123);
        // reload
        window.location.reload();
    }
});
}


