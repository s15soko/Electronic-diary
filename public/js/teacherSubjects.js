// create form to add new subject for teacher
function teacherSubjectFormBuilder()
{
    // find form div
    var form = document.getElementById("newForm");

    // if form is active turn it off
    var checkForm = form.querySelector(".activeNewForm");
    if(checkForm)
    {
        form.removeChild(checkForm);
        return;
    }
    

    // create div
    var div = document.createElement("div");
    div.setAttribute("class", "activeNewForm");
    // append div to form
    form.appendChild(div);




    // create paragraph 1
    var p1 = document.createElement("p");
    // append it to form
    div.appendChild(p1);
    // create h2 text
    var h1 = document.createElement("h2");
    h1.innerHTML = "Nauczyciel: ";
    // append h1 to p1
    p1.appendChild(h1);
    // create input 1
    var input1 = document.createElement("select");
    input1.setAttribute("id", "teacherSelect");
    input1.setAttribute("name", "teacherID");
    // append input1 to p1
    p1.appendChild(input1);
    // get options 
    getAllTeachers();


    // create paragraph 2
    var p2 = document.createElement("p");
    // append it to form
    div.appendChild(p2);
    // create h2 text
    var h2 = document.createElement("h2");
    h2.innerHTML = "Przedmiot: ";
    // append h2 to p2
    p2.appendChild(h2);
    // create input 2
    var input2 = document.createElement("select");
    input2.setAttribute("id", "subjectSelect");
    input2.setAttribute("name", "subjectID");
    // append input2 to p2
    p2.appendChild(input2);
    // get options 
    getAllSubjects();





    // submit
    // create paragraph 5
    var p5 = document.createElement("p");
    // append it to form
    div.appendChild(p5);
    // create input 5
    var input5 = document.createElement("input");
    input5.setAttribute("type", "submit");
    input5.setAttribute("onclick", "addNewTeacherSubject()");
    input5.setAttribute("value", "Dodaj do bazy");
    // append input5 to p5
    p5.appendChild(input5);

    
}

// add new subject for teacher
function addNewTeacherSubject()
{
    // get values
    var n1 = document.getElementsByName("teacherID")[0].value;
    var n2 = document.getElementsByName("subjectID")[0].value;

    // start ajax
    $.ajax({
        type: "post",
        url: "public/ajax/admin/ajax_teachersubject-add.php",
        data: ({
            teacherID: n1,
            subjectID: n2,
        }), 
        success: function()
        {
            // reload
            window.location.reload();
        }
    });

}


// get all subjects by ajax
function getAllSubjects()
{
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "public/ajax/admin/get/ajax_subjects-get.php",
        success: function(data)
        {
            // find by id
            var subjectSelect = document.getElementById("subjectSelect");
            
            // add options
            data.forEach(element => 
            {
                // create element
                var opt = document.createElement("option");
                opt.setAttribute("value", element['id']);
                opt.innerHTML = element['nazwa'];
                subjectSelect.appendChild(opt);
            });
        }
    });
}


// get all teachers by ajax
function getAllTeachers()
{
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "public/ajax/admin/get/ajax_teachers-get.php",
        success: function(data)
        {
            // find by id
            var teacherSelect = document.getElementById("teacherSelect");
            
            // add options
            data.forEach(element => 
            {
                // if 
                if(element['rola_uzytkownika'] !== "DYREKTOR")
                {
                    // create element
                    var opt = document.createElement("option");
                    opt.setAttribute("value", element['id']);
                    opt.innerHTML = element['imie'] + " " + element['nazwisko'];
                    teacherSelect.appendChild(opt);
                }
            });
        }
    }); 
}



// get all subjects for all teachers
// and create new td element for it
// use ajax request
function getAllTeachersSubjects()
{
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "public/ajax/admin/get/ajax_teacherSubjects-get.php",
        success: function(data)
        {
            // add options
            data.forEach(element => 
            {
                var tbody = document.getElementById(element['idnauczyciela']);
                if(tbody)
                {
                    // create row (tr)
                    var tr = document.createElement("tr");
                    tbody.appendChild(tr);

                    // create td for options
                    var tdoptions = document.createElement("td");
                    tdoptions.setAttribute("class", "form_input-options");
                    
                    tdoptionsinput = document.createElement("input");
                    tdoptionsinput.setAttribute("type", "checkbox");
                    tdoptionsinput.setAttribute("name", "teacherSubjects");
                    tdoptionsinput.setAttribute("value", element['id']);


                    var td = document.createElement("td");
                    td.innerHTML = element['pnazwa'] + " ("+element['pkrotka_nazwa']+")";


                    // append
                    tbody.appendChild(tr);
                    tr.appendChild(tdoptions);
                    tdoptions.appendChild(tdoptionsinput);
                    tr.appendChild(td);   
                }
            });
        }
    });
}