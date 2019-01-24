// create form to add new group
function groupFormBuilder()
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
    
    // create div (form)
    var div = document.createElement("form");
    div.setAttribute("class", "activeNewForm");
    // append div to form
    form.appendChild(div);




    // create paragraph 1
    var p1 = document.createElement("p");
    // append it to form
    div.appendChild(p1);
    // create h2 text
    var h1 = document.createElement("h2");
    h1.innerHTML = "Name: ";
    // append h1 to p1
    p1.appendChild(h1);
    // create input 1
    var input1 = document.createElement("input");
    input1.setAttribute("placeholder","Enter group name (class + direction)");
    input1.setAttribute("name", "group_name");
    input1.setAttribute("type", "text");
    // append input1 to p1
    p1.appendChild(input1);



    // create paragraph 2
    var p2 = document.createElement("p");
    // append it to form
    div.appendChild(p2);
    // create h2 text
    var h2 = document.createElement("h2");
    h2.innerHTML = "Group number: ";
    // append h2 to p2
    p2.appendChild(h2);
    // create input 2
    var input2 = document.createElement("input");
    input2.setAttribute("name", "group_number");
    input2.setAttribute("type", "number");
    // append input2 to p2
    p2.appendChild(input2);




    // create paragraph 3
    var p3 = document.createElement("p");
    // append it to form
    div.appendChild(p3);
    // create h2 text
    var h3 = document.createElement("h2");
    h3.innerHTML = "Class: ";
    // append h3 to p3
    p3.appendChild(h3);
    // create input 3
    var input3 = document.createElement("select");
    input3.setAttribute("id", "classSelect");
    input3.setAttribute("name", "classID");
    // append input3 to p3
    p3.appendChild(input3);
    // get options 
    getAllClasses();




    // create paragraph 4
    var p4 = document.createElement("p");
    // append it to form
    div.appendChild(p4);
    // create h2 text
    var h4 = document.createElement("h2");
    h4.innerHTML = "Direction: ";
    // append h4 to p4
    p4.appendChild(h4);
    // create input 4
    var input4 = document.createElement("select");
    input4.setAttribute("id", "directionSelect");
    input4.setAttribute("name", "directionID");
    // append input4 to p4
    p4.appendChild(input4);
    getAllDirections();



    // submit
    // create paragraph 5
    var p5 = document.createElement("p");
    // append it to form
    div.appendChild(p5);
    // create input 5
    var input5 = document.createElement("input");
    input5.setAttribute("type", "submit");
    input5.setAttribute("onclick", "addNewGroup()");
    input5.setAttribute("value", "Add");
    // append input5 to p5
    p5.appendChild(input5);

    
}


// create form to add user to group
function userGroupFormBuilder()
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
     
     // create div (form)
     var div = document.createElement("form");
     div.setAttribute("class", "activeNewForm");
     div.setAttribute("method", "POST");
     // append div to form
     form.appendChild(div);
     
    // create paragraph 1
    var p1 = document.createElement("p");
    // append it to form
    div.appendChild(p1);
    // create h2 text
    var h1 = document.createElement("h2");
    h1.innerHTML = "User: ";
    // append h1 to p1
    p1.appendChild(h1);
    // create input 1
    var input1 = document.createElement("select");
    input1.setAttribute("id", "userSelect");
    input1.setAttribute("required", "required");
    input1.setAttribute("name", "user");
    // append input1 to p1
    p1.appendChild(input1);
    // get options 
    getAllUsersWithoutGroup();


    // submit
    // create paragraph 2
    var p2 = document.createElement("p");
    // append it to form
    div.appendChild(p2);
    // create input 2
    var input2 = document.createElement("input");
    input2.setAttribute("type", "submit");
    input2.setAttribute("onclick", "addNewGroupUser()");
    input2.setAttribute("value", "Add");
    // append input2 to p2
    p2.appendChild(input2);
}

// get all users with out group
function getAllUsersWithoutGroup()
{
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "public/ajax/admin/get/ajax_usersWithoutGroup-get.php",
        success: function(data)
        {
            // find by id
            var userSelect = document.getElementById("userSelect");
            
            // add options
            data.forEach(element => 
            {
                // create element
                var opt = document.createElement("option");
                opt.setAttribute("value", element['user_id']);
                opt.innerHTML = element['name'] + " " + element['surname'] + " - " + element['PIN'];
                userSelect.appendChild(opt);
            });
        }
    }); 
}
// add user to group
function addNewGroupUser()
{
    var uid = document.getElementById("userSelect")[0].value;
    var gid = document.getElementById("userInGroup_form").getAttribute("data-groupid");


    // start ajax
    $.ajax({
        type: "POST",
        url: "public/ajax/admin/ajax_userToGroup-add.php",
        data: ({
            groupid: gid,
            userid: uid
        })
    });
}



// get all subjects for group (add data from other table)
function getSubjectsForGroup(groupid)
{
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        data: ({
            id: groupid
        }),
        url: "public/ajax/admin/get/ajax_subjectsForGroup-get.php",
        success: function(data)
        {
            // find by id
            var subjectSelect = document.getElementById("subjectSelectForGroup");

            data.forEach(element => 
            {
                // if null 
                if(element['group_id'] === null)
                {   
                    // create element
                    var opt = document.createElement("option");
                    opt.setAttribute("value", element['id']);
                    opt.innerHTML = element['name'];
                    subjectSelect.appendChild(opt);
                }

            });
        }
    });
}


// create form to add subject to group
function groupSubjectFormBuilder(id)
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
    h1.innerHTML = "Subject: ";
    // append h1 to p1
    p1.appendChild(h1);
    // create input 1
    var input1 = document.createElement("select");
    input1.setAttribute("id", "subjectSelectForGroup");
    input1.setAttribute("name", "subjectID");
    // append input1 to p1
    p1.appendChild(input1);
    // get options 
    getSubjectsForGroup(id);



    // submit
    // create paragraph 5
    var p5 = document.createElement("p");
    // append it to form
    div.appendChild(p5);
    // create input 5
    var input5 = document.createElement("input");
    input5.setAttribute("type", "submit");
    input5.setAttribute("onclick", "addNewSubjectToGroup("+id+")");
    input5.setAttribute("value", "Add");
    // append input5 to p5
    p5.appendChild(input5);

}

// add new subject to group
function addNewSubjectToGroup(id)
{
    var subID = document.getElementsByName("subjectID")[0].value;

    // start ajax
    $.ajax({
        type: "POST",
        url: "public/ajax/admin/ajax_subjectToGroup-add.php",
        data: ({
            groupid: id,
            subjectID: subID
        }),
        success: function()
        {
            // reload
            window.location.reload();
        }
    });
}



// get by ajax data from database
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


// get by ajax data from database
function getAllDirections()
{
    // start ajax
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "public/ajax/admin/get/ajax_directions-get.php",
        success: function(data)
        {
            // find by id
            var directionSelect = document.getElementById("directionSelect");
            
            // add options
            data.forEach(element => 
            {
                // create element
                var opt = document.createElement("option");
                opt.setAttribute("value", element['id']);
                opt.innerHTML = element['name'];
                directionSelect.appendChild(opt);


            });
        }
    });
    
}



// ajax for adding new group
function addNewGroup()
{
    var n1 = document.getElementsByName("group_name")[0].value;
    var n2 = document.getElementsByName("group_number")[0].value;
    var n3 = document.getElementsByName("classID")[0].value;
    var n4 = document.getElementsByName("directionID")[0].value;

    $.ajax({
        type: "post",
        url: "public/ajax/admin/ajax_group-add.php",
        data: ({
            name: n1,
            number: n2,
            classID: n3,
            directionID: n4
        }), 
        success: function()
        {
            // reload
            window.location.reload();
        }
    });
}


// ajax for edit / update group data 
function editGroup()
{
    // get values
    var eleN1 = document.getElementsByName("name")[0].value;
    var eleN2 = document.getElementsByName("number")[0].value;
    var eleN3 = document.getElementsByName("classid")[0].value;
    var eleN4 = document.getElementsByName("directionid")[0].value;
    var id_group = document.getElementsByName("id")[0].value;


    // start ajax
    $.ajax({
        type: "POST",
        url: "public/ajax/admin/ajax_group-update.php",
        data: ({
            name: eleN1,
            number: eleN2,
            classid: eleN3,
            directionid: eleN4,
            id: id_group
        }),
        success: function()
        {
            window.location.href = "?ap=groups";
        }
    });

}